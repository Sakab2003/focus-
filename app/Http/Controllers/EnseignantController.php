<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Devoir;
use App\Models\Matiere;
use App\Models\Message;
use App\Models\Enseignant;
use App\Models\SalleClasse;
use App\Models\Utilisateur;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AnneeScolaire;
use App\Models\ClasseVirtuelle;
use App\Models\EleveEnseignant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;






class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Données de base
        $messages = [];
        $notifications = [];

        $user = Auth::user();
        $enseignant = $user->enseignant;

        if (!$enseignant) {
            abort(403, 'Aucun enseignant associé à ce compte');
        }

        // ✅ CLASSES DE L’ENSEIGNANT (via table pivot enseignant_classe)
        $classes = ClasseVirtuelle::with('salle')
            ->whereHas('enseignants', function ($q) use ($enseignant) {
                $q->where('enseignants.id', $enseignant->id);
            })
            ->get();

        $classeIds = $classes->pluck('id');

        // ✅ COURS DE L’ENSEIGNANT (lien direct)
        $total_cours = Cours::where('id_enseignant', $enseignant->id)->count();

        // ✅ DEVOIRS DE SES COURS
        $total_devoirs = Devoir::whereHas('cours', function ($q) use ($enseignant) {
            $q->where('id_enseignant', $enseignant->id);
        })->count();

        // ✅ NOMBRE DE CLASSES
        $total_classes = $classes->count();

        // ✅ ÉLÈVES DES CLASSES DE L’ENSEIGNANT
        $total_eleves = Eleve::whereIn('id_classe', $classeIds)->count();

        return view('enseignant.dashboard', compact(
            'messages',
            'notifications',
            'enseignant',
            'classes',
            'total_cours',
            'total_devoirs',
            'total_classes',
            'total_eleves'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Toujours récupérer ou créer l’enseignant
    $enseignant = Enseignant::firstOrCreate(
        ['id_utilisateur' => Auth::id()],
        [
            'telephone' => null,
            'bibliographie' => null,
            'photo' => null,
        ]
    );

    $classes  = SalleClasse::all();
    $matieres = Matiere::all();

    return view('enseignant.ajout_classe', compact(
        'enseignant',
        'classes',
        'matieres'
    ));
}


/**public function create()
{
    // Toujours récupérer ou créer l’enseignant
    $enseignant = Enseignant::firstOrCreate(
        ['id_utilisateur' => Auth::id()],
        [
            'telephone' => null,
            'bibliographie' => null,
            'photo' => null,
        ]
    );

    $classes  = ClasseVirtuelle::all();
    $matieres = Matiere::all();

    return view('enseignant.ajout_classe', compact(
        'enseignant',
        'classes',
        'matieres'
    ));
}*/



    public function store(Request $request) {
        $request->validate([
            'salle_id' => 'required|exists:salle_classes,id',
            'matieres' => 'required|array',
            'matieres.*' => 'exists:matieres,id',
        ]);

        $enseignant = auth()->user()->enseignant;
        $salle = SalleClasse::findOrFail($request->salle_id);

    $classe = ClasseVirtuelle::create([
    'name' => $salle->nom,
    'id_utilisateur' => auth()->id(),
    'salle_id' => $request->salle_id,
]);

    // Lier enseignant
    $classe->enseignants()->attach($enseignant->id);

    // Lier matières
    $classe->matieres()->sync($request->matieres);

    return redirect()->route('enseignant.liste_classe')->with('success', 'Classe ajouté avec succès !');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enseignant = auth()->user()->enseignant;

    $classe = ClasseVirtuelle::with(['salle', 'matieres', 'enseignants'])
        ->where('id', $id)
        ->whereHas('enseignants', function ($q) use ($enseignant) {
            $q->where('enseignants.id', $enseignant->id);
        })
        ->firstOrFail();

    return view('enseignant.classe.show', compact('classe'));
    }
    public function update_classe_virtuelle(Request $request, $id)
{
    $request->validate([
        'salle_id' => 'required|exists:salle_classes,id',
        'matieres' => 'required|array',
        'matieres.*' => 'exists:matieres,id',
    ]);

    $classe = ClasseVirtuelle::findOrFail($id);

    // 🔐 sécurité : appartient à l’enseignant connecté
    if ($classe->id_utilisateur !== auth()->id()) {
        abort(403);
    }

    $salle = SalleClasse::find($request->salle_id);

$classe->update([
    'salle_id' => $request->salle_id,
    'name' => $salle->nom
]);

    $classe->matieres()->sync($request->matieres);

    return redirect()
        ->route('classe.liste')
        ->with('success', 'Classe modifiée avec succès');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enseignant = auth()->user()->enseignant;

    $classe = ClasseVirtuelle::with(['salle', 'matieres'])
        ->where('id', $id)
        ->whereHas('enseignants', function ($q) use ($enseignant) {
            $q->where('enseignants.id', $enseignant->id);
        })
        ->firstOrFail();

    $salles = SalleClasse::all();
    $matieres = Matiere::all();

    return view('enseignant.classe.edit', compact('classe', 'salles', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $enseignant = Auth::user()->enseignant;

        $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'bibliographie' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // PHOTO
        if ($request->hasFile('photo')) {

            if ($enseignant->photo) {
                Storage::delete('public/enseignants/' . $enseignant->photo);
            }

            $photoName = time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/enseignants', $photoName);

            $enseignant->photo = $photoName;
        }

        // AUTRES DONNÉES
        $enseignant->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'bibliographie' => $request->bibliographie,
        ]);
        

        return back()->with('success', 'Profil mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $classe = ClasseVirtuelle::findOrFail($id);

    // sécurité : vérifier que la classe appartient à l'enseignant
    if ($classe->id_utilisateur !== auth()->id()) {
        abort(403);
    }
    

    $classe->delete();

    return redirect()
        ->route('classe.liste')
        ->with('success', 'Classe supprimée avec succès');
}
    
    public function gest_eleve()
    {
        return view ('enseignant.gestion_eleve');
    }
    public function cours_ajout()
{
    $enseignantId = auth()->user()->id;

    // Classes virtuelles créées par l’enseignant
    $classes = ClasseVirtuelle::where('id_utilisateur', $enseignantId)->get();

    // Toutes les années scolaires existantes
    $annees = AnneeScolaire::all();

    return view('enseignant.ajoutcours', compact('classes', 'annees'));
}



// Nouvelle méthode pour récupérer les matières d'une classe
public function getMatieresClasse($classeId)
{
    $classe = ClasseVirtuelle::with('matieres')->find($classeId);
    
    if(!$classe) return response()->json([]);

    return response()->json($classe->matieres->map(function($matiere){
        return [
            'id' => $matiere->id,
            'name' => $matiere->name
        ];
    }));
}




    public function exercice_ajout()
    {
        return view('enseignant.exercice');
    }
    
    
    public function gererEleves()
{
    $enseignant = auth()->user()->enseignant;

    $eleves = Eleve::with([
        'parent.utilisateur',
        'classe'
    ])
    ->whereHas('classe', function ($query) use ($enseignant) {
        $query->where('id_enseignant', $enseignant->id_enseignant);
    })
    ->get();

    return view('enseignant.gestion_eleve', compact('eleves'));
}
public function profile()
{
    $user = Auth::user();

    // On vérifie si un profil enseignant existe pour l'utilisateur connecté, sinon on le crée
    $enseignant = Enseignant::firstOrCreate(
        ['id_utilisateur' => $user->id],
        [
            'nom' => $user->nom ?? '',
            'prenom' => $user->prenom ?? '',
            'email' => $user->email,
            'telephone' => '',
            'bibliographie' => '',
            'photo' => null,
        ]
    );

    return view('enseignant.profile', compact('enseignant'));
}
public function gererEleve(Request $request)
{
    $enseignant = auth()->user()->enseignant;

    // 1️⃣ Classes de l’enseignant avec des réponses
    $classes = ClasseVirtuelle::whereHas('enseignants', function ($q) use ($enseignant) {
        $q->where('enseignants.id', $enseignant->id);
    })
    ->whereHas('matieres.cours.devoirs.reponses')
    ->with('enseignants')
    ->get();

    $devoirs = collect();
    $eleves  = collect();

    // 2️⃣ Si une classe est sélectionnée
    if ($request->filled('classe_id')) {

        $classe = ClasseVirtuelle::with([
            'matieres.cours.devoirs.reponses.eleve'
        ])->findOrFail($request->classe_id);

        // 3️⃣ Tous les devoirs de la classe
        $devoirs = $classe->matieres->flatMap(fn ($matiere) =>
            $matiere->cours->flatMap(fn ($cours) =>
                $cours->devoirs
            )
        );

        // 4️⃣ Élèves ayant répondu
        $eleves = $devoirs->flatMap(fn ($devoir) => $devoir->reponses)
            ->pluck('eleve')
            ->unique('id');

        // 5️⃣ 🔥 GÉNÉRATION DES PDF (ICI ET NULLE PART AILLEURS)
        foreach ($devoirs as $devoir) {
            foreach ($devoir->reponses as $reponse) {

                // 🔹 PDF depuis réponse texte
                if (!empty($reponse->reponse)) {

                    $pdfPath = "reponses_txt/reponse_{$reponse->id}.pdf";

                    if (!Storage::disk('public')->exists($pdfPath)) {

                        $pdf = Pdf::loadView('pdf.reponse', [
                            'reponse' => $reponse
                        ]);

                        Storage::disk('public')->put(
                            $pdfPath,
                            $pdf->output()
                        );
                    }
                }
            }
        }
    }

    return view('enseignant.gestion_eleve', compact(
        'classes',
        'devoirs',
        'eleves'
    ));
}

public function attribuerNote(Request $request)
{
    $request->validate([
        'reponse_id' => 'required|exists:reponse_devoirs,id',
        'note' => 'required|numeric|min:0|max:20',
    ]);

    $reponse = \App\Models\ReponseDevoir::with(['eleve', 'devoir'])
        ->findOrFail($request->reponse_id);

    // 🔹 créer OU mettre à jour la note
    \App\Models\Note::updateOrCreate(
        [
            'id_eleve'  => $reponse->eleve_id,
            'id_devoir' => $reponse->devoir_id,
        ],
        [
            'valeur' => $request->note,
        ]
    );

    return back()->with('success', 'Note enregistrée avec succès');
}
public function envoyerRemarque(Request $request)
{
    $request->validate([
        'eleve_id' => 'required|exists:eleves,id',
        'devoir_id' => 'required|exists:devoirs,id',
        'remarque' => 'nullable|string', // ou 'required|string' si tu veux forcer une remarque
    ]);

    // Récupérer la note existante pour cet élève et ce devoir
    $note = \App\Models\Note::where('id_eleve', $request->eleve_id)
                ->where('id_devoir', $request->devoir_id)
                ->first();

    if (!$note) {
        // Si la note n'existe pas encore, on la crée avec la remarque
        $note = \App\Models\Note::create([
            'id_eleve' => $request->eleve_id,
            'id_devoir' => $request->devoir_id,
            'valeur' => null,       // ou 0 si tu veux une valeur par défaut
            'remarque' => $request->remarque,
        ]);
    } else {
        // Sinon, on met simplement à jour la remarque
        $note->remarque = $request->remarque;
        $note->save();
    }

    return back()->with('success', 'Remarque enregistrée avec succès !');
}


public function telechargerReponse($id)
{
    $reponse = \App\Models\ReponseDevoir::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | 1️⃣ PRIORITÉ AU FICHIER UPLOADÉ
    |--------------------------------------------------------------------------
    */
    if (!empty($reponse->fichier)) {

        $filePath = storage_path("app/public/{$reponse->fichier}");

        if (file_exists($filePath)) {
            return response()->download(
                $filePath,
                basename($filePath)
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 2️⃣ SINON → PDF GÉNÉRÉ À PARTIR DU TEXTE
    |--------------------------------------------------------------------------
    */
    if (!empty($reponse->reponse)) {

        $pdfPath = storage_path(
            "app/public/reponses_txt/reponse_{$reponse->id}.pdf"
        );

        if (file_exists($pdfPath)) {
            return response()->download(
                $pdfPath,
                "Reponse_{$reponse->id}.pdf"
            );
        }
    }

    abort(404, 'Fichier introuvable');
}
public function telechargerFichier($id)
{
    $reponse = \App\Models\ReponseDevoir::findOrFail($id);

    if (!$reponse->fichier) {
        abort(404, 'Aucun fichier envoyé');
    }

    $path = storage_path("app/public/{$reponse->fichier}");

    if (!file_exists($path)) {
        abort(404, 'Fichier introuvable');
    }

    return response()->download($path, basename($path));
}
public function telechargerContenu($id)
{
    $reponse = \App\Models\ReponseDevoir::findOrFail($id);

    if (!$reponse->reponse) {
        abort(404, 'Aucun contenu texte');
    }

    $pdfPath = "reponses_txt/reponse_{$reponse->id}.pdf";

    if (!Storage::disk('public')->exists($pdfPath)) {

        $pdf = Pdf::loadView('pdf.reponse', [
            'reponse' => $reponse
        ]);

        Storage::disk('public')->put($pdfPath, $pdf->output());
    }

    return response()->download(
        storage_path("app/public/$pdfPath"),
        "Reponse_{$reponse->id}.pdf"
    );
}
public function search(Request $request)
{
    $q = $request->q;

    if (!$q) {
        return redirect()->back();
    }

    $enseignantId = auth()->user()->id;

    $cours = Cours::where('id_enseignant', $enseignantId)
        ->where('titre', 'like', "%$q%")
        ->get();

    $classes = ClasseVirtuelle::where('id_utilisateur', $enseignantId)
        ->where('name', 'like', "%$q%")
        ->get();

    return view('enseignant.search', compact('q', 'cours', 'classes', ));
}
public function listeEleves()
{
    $enseignant = Auth::user()->enseignant;

    // 1️⃣ Récupérer les cours de l’enseignant
    $cours = Cours::with([
        'matiere.classes.eleves',
        'matiere.classes.enseignants'
    ])
    ->where('id_enseignant', $enseignant->id)
    ->get();

    // 2️⃣ Construire une structure élève → matières → cours
    $eleves = [];

    foreach ($cours as $cour) {
        foreach ($cour->matiere->classes as $classe) {

    // 🔐 vérifier que l’enseignant enseigne bien dans cette classe
    if (!$classe->enseignants->contains($enseignant->id)) {
        continue;
    }
            foreach ($classe->eleves as $eleve) {

                $eleves[$eleve->id]['eleve'] = $eleve;
                $eleves[$eleve->id]['classes'][$classe->id] = $classe->name;
                $eleves[$eleve->id]['matieres'][$cour->matiere->id] = $cour->matiere->name;
                $eleves[$eleve->id]['cours'][] = $cour->titre;
            }
        }
    }

    return view('enseignant.liste_eleves', [
        'eleves' => $eleves
    ]);
}
/*public function listeEleves()
{
    // 1️⃣ Enseignant connecté
    $enseignant = auth()->user()->enseignant;

    // Sécurité
    if (!$enseignant) {
        abort(403, 'Accès refusé');
    }

    // 2️⃣ Récupérer les matières où l’enseignant a des cours
    $matiereIds = Cours::where('id_enseignant', $enseignant->id)
        ->pluck('id_matiere')
        ->unique();

    // 3️⃣ Récupérer les classes liées à ces matières
    $classeIds = \App\Models\Matiere::whereIn('id', $matiereIds)
    ->with('classes:id')
    ->get()
    ->pluck('classes')
    ->flatten()
    ->pluck('id')
    ->unique();

    // 4️⃣ Récupérer les élèves de ces classes
    $eleves = Eleve::whereIn('id_classe', $classeIds)
        ->with(['classe', 'enseignant'])
        ->get();

    return view('enseignant.liste_eleves', compact('eleves'));
}*/
public function supprimerEleveCours($id_eleve, $id_cours)
{
    // Récupérer le cours
    $cours = Cours::findOrFail($id_cours);

    // Vérifier que l'enseignant connecté est bien l'auteur du cours
    if ($cours->id_enseignant != auth()->user()->enseignant->id) {
        abort(403, "Vous n'êtes pas autorisé à supprimer cet élève de ce cours");
    }

    // Supprimer l'élève de la table pivot ou table de relation
    EleveEnseignant::where('id_enseignant', auth()->user()->enseignant->id)
        ->where('id_eleve', $id_eleve)
        ->delete();

    return redirect()->route('enseignant.liste_eleves')
        ->with('success', 'Élève supprimé du cours avec succès.');
}
public function voirParent($eleveId)
{
    $eleve = Eleve::with(['parent.utilisateur', 'classe'])
        ->findOrFail($eleveId);

    $parent = $eleve->parent;

    return view('enseignant.voir_parent', compact('eleve', 'parent'));
}


}
