<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Devoir;

use App\Models\SalleClasse;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;


class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $salles = SalleClasse::whereHas('classesVirtuelles')
        ->with([
            'classesVirtuelles.matieres',
            'classesVirtuelles.enseignant'
        ])
        ->get();

    return view('eleves.create', compact('salles'));
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
    public function inscription()
    {
        // Récupérer toutes les salles avec leurs classes virtuelles et relations nécessaires
        $salles = SalleClasse::whereHas('classesVirtuelles')
            ->with([
                'classesVirtuelles.matieres',
                'classesVirtuelles.enseignant'
            ])
            ->get();

        return view('parent.eleve.inscription', compact('salles'));
    }

    /**
     * Traitement de l'inscription d'un élève
     */
    public function inscription_eleve_traitement(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'classe_id' => 'required|exists:classe_virtuelles,id',
    ]);

    $parent = auth()->user()->parent;
    $classe = ClasseVirtuelle::findOrFail($request->classe_id);

    $eleve = new Eleve();
    $eleve->nom = $request->nom;
    $eleve->prenom = $request->prenom;
    $eleve->id_classe = $classe->id;
    $eleve->id_parent = $parent->id;

    $enseignant = $classe->enseignants->first();
    $eleve->id_enseignant = $enseignant ? $enseignant->id : null;

    $eleve->save();

    return redirect()->route('parent.eleve.liste_inscription')
                     ->with('success', "L'élève {$eleve->nom} {$eleve->prenom} a été inscrit avec succès !");
}



    /**
     * Liste des élèves d'un parent
     */
    public function liste()
{
    $parent = auth()->user()->parent;

    if (!$parent) {
        return back()->withErrors("Aucun parent associé à ce compte.");
    }

    // 🔹 Récupérer toutes les classes auxquelles le parent a inscrit au moins un enfant
    $classes = \App\Models\ClasseVirtuelle::whereIn(
        'id',
        $parent->eleves->pluck('id_classe')
    )->with(['enseignants', 'matieres'])->get();

    // 🔹 Optionnel : récupérer les devoirs si une classe est sélectionnée
    $devoirs = collect();
    if (request()->filled('classe_id')) {
        $classeId = request('classe_id');

        // Exemple simple : tous les devoirs de la classe
        $devoirs = \App\Models\Devoir::where('id_classe', $classeId)->get();
    }

    return view('parent.eleve.liste', compact('classes', 'devoirs'));
}



    /**
     * Afficher le formulaire de modification d'un élève
     */
    public function update_eleve($id)
{
    $eleve = Eleve::findOrFail($id);
    $salles = SalleClasse::whereHas('classesVirtuelles.enseignants') // seulement les salles avec enseignants
        ->with(['classesVirtuelles.matieres', 'classesVirtuelles.enseignants'])
        ->get();

    return view('parent.eleve.update', compact('eleve', 'salles'));
}

    /**
     * Traitement de la modification d'un élève
     */
    public function update_eleve_traitement(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'classe_id' => 'required|exists:classe_virtuelles,id',
    ]);

    $eleve = Eleve::findOrFail($id); // <- ID depuis l'URL
    $eleve->nom = $request->nom;
    $eleve->prenom = $request->prenom;
    $eleve->id_classe = $request->classe_id;
    $eleve->save();

    return redirect('/parent/eleve/liste_inscription')->with('success', 'L\'élève a été modifié avec succès.');
}

    /**
     * Supprimer un élève
     */
    public function delete_eleve($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        return redirect()->back()->with('success', 'Élève supprimé avec succès');
    }
public function listeDevoirs(Request $request)
{
    $parent = auth()->user()->parent;

    if (!$parent) {
        return back()->withErrors("Aucun parent associé à ce compte.");
    }

    // Récupérer les classes du parent
    $classes = ClasseVirtuelle::whereIn(
        'id',
        $parent->eleves->pluck('id_classe')
    )->with(['enseignants', 'matieres'])->get();

    $devoirs = collect();

    if ($request->filled('classe_id')) {
        $classeId = $request->classe_id;

        // 🔹 Récupérer la classe avec ses matières, cours et devoirs
        $classe = ClasseVirtuelle::with(
    'matieres.cours.devoirs.cours'
)->find($classeId);


        if ($classe) {
            // 🔹 Extraire tous les devoirs via flatMap
            $devoirs = $classe->matieres
                ->flatMap(fn($matiere) => $matiere->cours
                    ->flatMap(fn($cours) => $cours->devoirs));
        }
    }

    return view('parent.eleve.liste', compact('classes', 'devoirs'));
}
public function traiterDevoir(Request $request)
{
    $request->validate([
        'devoir_id' => 'required|exists:devoirs,id'
    ]);

    $devoir = Devoir::with('cours.matiere.classes')->findOrFail($request->devoir_id);

    $parent = auth()->user()->parent;

    // 🔥 récupérer les classes liées à la matière du devoir
    $classes = $devoir->cours->matiere->classes;

    // 🔥 trouver la classe du parent parmi celles-ci
    $classe = $classes->first(function ($classe) use ($parent) {
        return $parent->eleves->contains('id_classe', $classe->id);
    });

    if (!$classe) {
        return back()->withErrors("Aucune classe correspondante trouvée.");
    }

    // 🔥 récupérer les élèves du parent dans cette classe
    $eleves = $parent->eleves()
        ->where('id_classe', $classe->id)
        ->get();

    return view('parent.eleve.eleves_liste', compact('eleves', 'classe', 'devoir'));
}
public function traiterDevoirEleve(Request $request)
{
    $request->validate([
        'devoir_id' => 'required|exists:devoirs,id',
        'eleve_id'  => 'required|exists:eleves,id',
    ]);

    $parent = auth()->user()->parent;

    // Sécurité : vérifier que l’élève appartient bien au parent
    $eleve = $parent->eleves()->findOrFail($request->eleve_id);

    $devoir = Devoir::with('cours')->findOrFail($request->devoir_id);

    // 👉 ICI tu rediriges vers la vraie page de traitement
    return view('parent.devoir.traitement', compact('devoir', 'eleve'));
}
public function formTraitementDevoirEleve(Request $request)
{
    $devoir = Devoir::findOrFail($request->devoir_id);
    $parent = auth()->user()->parent;
    $eleve  = $parent->eleves()->findOrFail($request->eleve_id);

    return view('parent.devoir.traitement', compact('devoir', 'eleve'));
}

public function envoyerReponseDevoir(Request $request)
{
    $request->validate([
        'devoir_id' => 'required|exists:devoirs,id',
        'eleve_id'  => 'required|exists:eleves,id',
        'reponse'   => 'nullable|string',
        'fichier'   => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,txt|max:5120',
    ]);

    $devoir = Devoir::findOrFail($request->devoir_id);
    $eleve  = Eleve::findOrFail($request->eleve_id);

    // 🔥 👉 METS ÇA ICI (avant tout)
    if (!$request->reponse && !$request->hasFile('fichier')) {
        return back()->with('error', "Vous devez écrire une réponse ou ajouter un fichier.");
    }

    // ✅ Vérification date limite
    if ($devoir->date_limite && now()->gt($devoir->date_limite)) {
        return back()->with('error', "La date limite pour ce devoir est dépassée.");
    }

    // ✅ Vérification doublon
    $reponseExistante = \App\Models\ReponseDevoir::where('devoir_id', $devoir->id)
        ->where('eleve_id', $eleve->id)
        ->first();

    if ($reponseExistante) {
        return back()->with('error', "Vous avez déjà envoyé votre réponse pour ce devoir.");
    }

    $fichierPath = null;
    if ($request->hasFile('fichier')) {
        $fichierPath = $request->file('fichier')->store('reponses', 'public');
    }

    \App\Models\ReponseDevoir::create([
        'devoir_id' => $devoir->id,
        'eleve_id'  => $eleve->id,
        'reponse'   => $request->reponse ?? '', // ✅ OK
        'fichier'   => $fichierPath,
        'envoye_par'=> 'parent',
    ]);

    Notification::create([
        'user_id' => $devoir->cours->enseignant->id,
        'message' => "Nouvelle réponse au devoir '{$devoir->titre}' de {$eleve->nom} {$eleve->prenom}.",
    ]);

    return back()->with('success', 'Réponse envoyée avec succès !');
}
public function voir($id)
    {
        $classe = ClasseVirtuelle::with(['eleves', 'enseignants', 'matieres'])->findOrFail($id);
        return view('parent.eleve.voir', compact('classe'));
    }

}
