<?php

namespace App\Http\Controllers;

use App\Models\cours;
use App\Models\Eleve;
use App\Models\Devoir;
use App\Models\Message;
use App\Models\Enseignant;
use App\Models\SalleClasse;
use App\Models\Utilisateur;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;




class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $parent = Auth::user()->parent;

    $eleveIds = $parent->eleves()->pluck('id');

    $classeIds = \App\Models\Eleve::whereIn('id', $eleveIds)
        ->pluck('id_classe')
        ->unique();

    $total_classes = $classeIds->count();

    $matiereIds = \Illuminate\Support\Facades\DB::table('classe_matiere')
    ->whereIn('classe_id', $classeIds)
    ->pluck('matiere_id')
    ->unique();


    $total_cours = \App\Models\Cours::whereIn('id_matiere', $matiereIds)->count();

    $total_enseignants = \App\Models\Cours::whereIn('id_matiere', $matiereIds)
        ->distinct('id_enseignant')
        ->count('id_enseignant');

    $total_eleves = $parent->eleves()->count();

    return view('parent.dashboard', compact(
        'total_classes',
        'total_cours',
        'total_enseignants',
        'total_eleves'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function liste_eleve()
{
    $eleves = Eleve::with('classes')->get();

    return view('parent.eleve.liste', compact('eleves'));
}
    public function inscription_eleve()
{
    // 🔹 On récupère les salles créées par l'admin ET ayant au moins une classe virtuelle
    $salles = SalleClasse::whereHas('classesVirtuelles')
    ->with(['classesVirtuelles.matieres', 'classesVirtuelles.enseignants']) // <-- pluriel
    ->get();

    return view('parent.eleve.inscription', compact('salles'));
}

    public function enseignant_eleve()
    {
        return view('parent.eleve.enseignant');
    }
    public function cours1()
    {
        return view ('parent.eleve.cours1');
    }
    public function cours2()
    {
        return view ('parent.eleve.cours2');
    }
    public function cours3()
    {
        return view ('parent.eleve.cours3');
    }
    public function cours4()
    {
        return view ('parent.eleve.cours4');
    }public function cours5()
    {
        return view ('parent.eleve.cours5');
    }
    public function cours6()
    {
        return view ('parent.eleve.cours6');
    }
    public function cours7()
    {
        return view ('parent.eleve.cours7');
    }
    public function cours8()
    {
        return view ('parent.eleve.cours8');
    }
    public function gestion_eleve()
    {
        return view('parent.suivi');
    }
    public function choixEnseignant()
    {
        $enseignants = Utilisateur::where('role','enseignant')
        ->whereHas('classe_virtuelle')
        ->with('classe_virtuelle')->get();
        return view('parent.eleve.enseignant',compact('enseignants'));
    }
    public function envoyerMessage(Request $request)
{
    $request->validate([
        'id_enseignant' => 'required',
        'content' => 'required'
    ]);

    // 1. Le message
    Message::create([
        'sender_id' => Auth::id(),       // le parent
        'receiver_id' => $request->id_enseignant, 
        'content' => $request->content,
        'read_at' => false
    ]);

    // 2. Une notification pour prévenir l'enseignant
    Notification::create([
        'id_utilisateur' => $request->id_enseignant,
        'message' => "Nouveau message reçu d'un parent.",
        'read' => false
    ]);

    return back()->with('success', 'Message envoyé à l’enseignant.');
}
  //Méthode pour traiter l'inscription réelle d'un élève
     
    public function storeEleve(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'classe_id' => 'required|exists:classe_virtuelles,id',
    ]);

    $parent = auth()->user()->parent;

    if (!$parent) {
        return back()->withErrors("Aucun parent associé à ce compte.");
    }

    Eleve::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'id_classe' => $request->classe_id,
        'id_parent' => $parent->id, // 🔥 LA LIGNE MANQUANTE
    ]);

    return back()->with('success', 'Élève inscrit avec succès');
}





    public function messages()
{
    $messages = Message::where('sender_id', Auth::id())->get();

    return view('parent.messages.index', compact('messages'));
}
public function coursParClasse(Request $request)
{
    // 🔹 1. Classes accessibles au parent
    $classes = ClasseVirtuelle::whereIn(
        'id',
        auth()->user()
            ->parent
            ->eleves
            ->pluck('id_classe')
    )
    ->with(['enseignants', 'matieres', 'salle'])
    ->get();

    // 🔹 2. Si aucune classe sélectionnée → afficher juste la page
    if (!$request->filled('classe_id')) {
        return view('parent.cours', [
            'classes' => $classes,
            'cours'   => collect(), // collection vide
        ]);
    }

    // 🔹 3. Sinon charger les cours
    $classeId = $request->classe_id;

    $enseignantsIds = DB::table('enseignant_classe')
        ->where('classe_id', $classeId)
        ->pluck('enseignant_id');

    $matieresIds = DB::table('classe_matiere')
        ->where('classe_id', $classeId)
        ->pluck('matiere_id');

    $cours = Cours::with(['enseignant', 'matiere'])
        ->whereIn('id_enseignant', $enseignantsIds)
        ->whereIn('id_matiere', $matieresIds)
        ->get();
        foreach ($cours as $c) {
    $c->classe = ClasseVirtuelle::find($classeId);
}

    return view('parent.cours', [
        'classes' => $classes, // ✅ OBLIGATOIRE
        'cours'   => $cours,
    ]);
}






public function coursClasse($id_classe)
{
    $cours = \App\Models\Cours::where('id_classe', $id_classe)->get();
    $classe = \App\Models\ClasseVirtuelle::find($id_classe);

    return view('parent.cours_liste', compact('cours', 'classe'));
}


public function voirProfilEnseignant($id)
{
    $enseignant = \App\Models\Utilisateur::findOrFail($id);
    return view('enseignant.profil_parent', compact('enseignant'));
}
public function telechargerContenu(Cours $cours)
{
    if (!$cours->contenu) {
        abort(404);
    }

    $pdf = Pdf::loadView('pdf.cours', [
        'cours' => $cours
    ]);

    return $pdf->download(
        'cours_'.$cours->id.'.pdf'
    );
}
public function listeInscriptions(Request $request)
{
    $parent = auth()->user()->parent; // relation parent
    $classeId = $request->get('classe_id');

    $eleves = Eleve::where('id_parent', $parent->id)
        ->when($classeId, fn ($q) => $q->where('id_classe', $classeId))
        ->get();

    return view('parent.eleve.liste_inscription', compact('eleves'));

}

public function inscriptionEleve()
{
    $parent = auth()->user()->parent;

    if (!$parent) {
        abort(403);
    }
    $eleves = Eleve::where('id_parent', $parent->id)
        ->with([
            'classe',              // ✅ SINGULIER
            'classe.matieres',     // ✅ OK
            'classe.enseignants'   // ✅ OK
        ])
        ->get();
    $salles = SalleClasse::whereHas('classesVirtuelles')
        ->with(['classesVirtuelles.matieres', 'classesVirtuelles.enseignants'])
        ->get();

    return view('parent.eleve.liste_inscription', compact('salles','eleves'));
}
public function store_Eleve(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'classe_id' => 'required|exists:classe_virtuelles,id',
    ]);

    $parent = auth()->user()->parent;

    Eleve::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'id_classe' => $request->classe_id,
        'id_parent' => $parent->id,
    ]);

    return redirect()
        ->route('parent.eleve.liste_inscription')
        ->with('success', 'Élève inscrit avec succès');
}


public function notes(Request $request)
{
    $parent = auth()->user()->parent;

    $classes = ClasseVirtuelle::whereHas('eleves', function ($q) use ($parent) {
        $q->where('id_parent', $parent->id);
    })->with('eleves')->get();

    $eleves = collect();

    if ($request->filled('classe_id')) {
        $eleves = Eleve::with([
            'classe',
            'notes.devoir.cours.matiere',       // Matière via cours
            'notes.devoir.cours.enseignant'    // Enseignant via cours
        ])
        ->where('id_parent', $parent->id)
        ->where('id_classe', $request->classe_id)
        ->get();
    }

    return view('parent.note', compact('classes', 'eleves'));
}
public function voir($id)
{
    $devoir = Devoir::with('cours')->findOrFail($id);
    $salles = SalleClasse::with('classesVirtuelles.enseignants', 'classesVirtuelles.matieres')->get();
    return view('parent.devoir_voir', compact('devoir', 'salles'));
}
public function remarques(Request $request)
{
    $parent = auth()->user()->parent;

    // 🔥 Classes uniquement liées aux enfants du parent
    $classeIds = $parent->eleves()
        ->pluck('id_classe')
        ->unique();

    $classes = ClasseVirtuelle::whereIn('id', $classeIds)->get();

    $eleves = collect();

    if ($request->filled('classe_id')) {
        $eleves = Eleve::with([
                'classe',
                'notes.devoir.cours.enseignant',
                'notes.devoir.cours.matiere'
            ])
            ->where('id_parent', $parent->id)
            ->where('id_classe', $request->classe_id)
            ->get();
    }

    return view('parent.remarque', compact('classes', 'eleves'));
}
public function telechargerDevoir(Devoir $devoir)
{
    // 1️⃣ Vérifier si le devoir a un fichier
    if (!$devoir->fichier) {
        return back()->with('error', 'Aucun fichier disponible pour ce devoir.');
    }

    // 2️⃣ Construire le chemin complet
    $path = storage_path('app/public/devoirs/' . $devoir->fichier);

    // 🔹 Ajouter des logs pour vérifier le nom et le chemin
    Log::info('Téléchargement de devoir : '.$devoir->fichier);
    Log::info('Chemin du fichier : '.$path);

    // 3️⃣ Vérifier si le fichier existe réellement
    if (!file_exists($path)) {
        return back()->with('error', 'Le fichier n’existe pas sur le serveur.');
    }

    // 4️⃣ Forcer le téléchargement avec un nom sûr
    return response()->file(storage_path('app/public/devoirs/Diagramme de ca d\'utilisation.pdf'));


}

public function devoirsParClasse(Request $request)
{
    $parent = auth()->user()->parent;

    $classes = ClasseVirtuelle::whereIn(
        'id',
        $parent->eleves->pluck('id_classe')
    )->get();

    if (!$request->filled('classe_id')) {
        return view('parent.devoirs', [
            'classes' => $classes,
            'devoirs' => collect()
        ]);
    }

    $classeId = $request->classe_id;

    // 🔹 récupérer enseignants de la classe
    $enseignantsIds = DB::table('enseignant_classe')
        ->where('classe_id', $classeId)
        ->pluck('enseignant_id');

    // 🔹 récupérer matières de la classe
    $matieresIds = DB::table('classe_matiere')
        ->where('classe_id', $classeId)
        ->pluck('matiere_id');

    // 🔥 récupérer les devoirs via les cours
    $devoirs = Devoir::whereHas('cours', function ($query) use ($enseignantsIds, $matieresIds) {
        $query->whereIn('id_enseignant', $enseignantsIds)
              ->whereIn('id_matiere', $matieresIds);
    })->with('cours')->get();

    return view('parent.eleve.liste', [
    'classes' => $classes,
    'devoirs' => $devoirs
]);
}

}