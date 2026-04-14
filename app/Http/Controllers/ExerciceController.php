<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Exercice;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;
use Illuminate\Support\Facades\Storage;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercice = Exercice::all(); 
        return view('enseignant.listeexercice', compact('exercice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseignant.exercice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exercice = Exercice::findOrFail($id);
    return view('enseignant.exercice.show', compact('exercice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exercice = Exercice::findOrFail($id);
    return view('enseignant.exercice.edit', compact('exercice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $exercice = Exercice::findOrFail($id);

    $request->validate([
        'titre' => 'required|string|max:255',
        'id_classe' => 'required|exists:classe_virtuelles,id_classe',
        'contenu' => 'nullable|string',
        'fichier' => 'nullable|mimes:pdf|max:2048',
        'fichiers.*' => 'nullable|file|max:4096',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Validation : au moins un contenu ou fichier
    |--------------------------------------------------------------------------
    */
    $hasContenu = trim(strip_tags($request->contenu)) !== '';
    $hasPdf = $request->hasFile('fichier');
    $hasFiles = $request->hasFile('fichiers');

    if (!$hasContenu && !$hasPdf && !$hasFiles) {
        return back()->withErrors([
            'contenu' => 'Veuillez saisir un contenu ou ajouter au moins un fichier.'
        ])->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Remplissage SANS sauvegarde (clé du système)
    |--------------------------------------------------------------------------
    */
    $exercice->fill([
        'titre' => $request->titre,
        'id_classe' => $request->id_classe,
        'contenu' => $request->contenu,
    ]);

    $hasDelete = $request->filled('delete_files');

    /*
    |--------------------------------------------------------------------------
    | 🔴 AUCUNE MODIFICATION → comportement "Annuler"
    |--------------------------------------------------------------------------
    */
    if (
        !$exercice->isDirty() &&
        !$hasPdf &&
        !$hasFiles &&
        !$hasDelete
    ) {
        return redirect()->route('exercice.liste');
    }

    /*
    |--------------------------------------------------------------------------
    | PDF principal
    |--------------------------------------------------------------------------
    */
    if ($hasPdf) {
        if ($exercice->fichier) {
            Storage::disk('public')->delete($exercice->fichier);
        }
        $exercice->fichier = $request->file('fichier')
            ->store('exercice/pdf', 'public');
    }

    /*
    |--------------------------------------------------------------------------
    | Fichiers multiples
    |--------------------------------------------------------------------------
    */
    $fichiers = $exercice->fichiers ?? [];

    // Suppression
    if ($hasDelete) {
        foreach ($request->delete_files as $index) {
            if (isset($fichiers[$index])) {
                Storage::disk('public')->delete($fichiers[$index]);
                unset($fichiers[$index]);
            }
        }
    }

    // Ajout
    if ($hasFiles) {
        foreach ($request->file('fichiers') as $file) {
            $fichiers[] = $file->store('exercice/fichiers', 'public');
        }
    }

    $exercice->fichiers = array_values($fichiers);

    /*
    |--------------------------------------------------------------------------
    | Sauvegarde finale
    |--------------------------------------------------------------------------
    */
    $exercice->save();

    return redirect()
        ->route('exercice.liste')
        ->with('status', 'Exercice mis à jour avec succès.');
}


// Formulaire de modification

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exercice = Exercice::findOrFail($id);

    // Supprimer le PDF principal
    if ($exercice->fichier) {
        Storage::disk('public')->delete($exercice->fichier);
    }

    // Supprimer les autres fichiers
    if ($exercice->fichiers) {
        foreach ($exercice->fichiers as $file) {
            Storage::disk('public')->delete($file);
        }
    }

    $exercice->delete();

    // Redirection propre vers liste des exercices avec un message flash
    return redirect()->route('exercice.liste')->with('status', 'L\'exercice a bien été supprimé.');
    }
    public function exercice_liste()
    {
        // Récupération des exercices
        $exercice = Exercice::all();

        // Envoi des données à la vue
        return view('enseignant.listeexercice', compact('exercice'));
    }
    public function exercice_ajout_traitement(Request $request)
{
    // Validation de base
    $request->validate([
        'titre' => 'required|string|max:255',
        'id_classe' => 'required|exists:classe_virtuelles,id_classe',
        'contenu' => 'nullable|string',
        'fichier' => 'nullable|mimes:pdf|max:2048',
        'fichiers.*' => 'nullable|file|max:4096',
    ]);

    $hasContenu = trim(strip_tags($request->contenu)) !== '';
    $hasPdf = $request->hasFile('fichier');
    $hasFiles = $request->hasFile('fichiers');

    if (!$hasContenu && !$hasPdf && !$hasFiles) {
        return back()
            ->withErrors([
                'contenu' =>
                    'Veuillez saisir un contenu ou ajouter au moins un fichier.'
            ])
            ->withInput();
    }

    $exercice = new Exercice();
    $exercice->titre = $request->titre;
    $exercice->id_classe = $request->id_classe;
    $exercice->contenu = $request->contenu;

    if ($request->hasFile('fichier')) {
        $exercice->fichier = $request->file('fichier')
            ->store('exercice/pdf', 'public');
    }

    $filesPath = [];
    if ($request->hasFile('fichiers')) {
        foreach ($request->file('fichiers') as $file) {
            $filesPath[] = $file->store('exercice/fichiers', 'public');
        }
    }
    $exercice->fichiers = $filesPath;

    $exercice->save();

    return redirect('/enseignant/exercice')
       ->with('status', "L'exercice a bien été ajouté.");
}


public function exerciceParClasse(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', "Vous devez être connecté.");
    }

    $parent = $user->parent;

    if (!$parent) {
        return view('parent.exercice', [
            'classes' => collect(),
            'exercice' => collect(),
            'message' => "Aucun parent lié à votre compte."
        ]);
    }

    $classeIds = Eleve::where('id_parent', $parent->id_parent)->pluck('id_classe')->unique();

    $classes = ClasseVirtuelle::whereIn('id_classe', $classeIds)->get();

    // si le parent choisit une classe
    $exercice = collect();
    if ($request->filled('classe_id')) {
        $exercice = Exercice::where('id_classe', $request->classe_id)->get();
    }

    return view('parent.exercice', compact('classes','exercice'));
}



public function exerciceClasse($id_classe)
{
    $cours = \App\Models\Exercice::where('id_classe', $id_classe)->get();
    $classe = \App\Models\ClasseVirtuelle::find($id_classe);

    return view('parent.exercice_liste', compact('exercice', 'classe'));
}

public function exercice()
{
    $parent = \App\Models\Le__Parent::where('id_utilisateur', auth()->user()->id_utilisateur)->first();

    // Récupérer les classes des enfants du parent
    $classIds = Eleve::where('id_parent', $parent->id_parent)->pluck('id_classe')->unique();

    // Récupérer tous les exercices de ces classes
    $exercice = Exercice::whereIn('id_classe', $classIds)->get();

    // Préparer les élèves par exercice
    $elevesParExercice = [];

    foreach($exercice as $exercice) {
        $elevesParExercice[$exercice->id] = Eleve::where('id_parent', $parent->id_parent)
                                                ->where('id_classe', $exercice->id_classe)
                                                ->get();
    }

    return view('parent.exercice', compact('exercices', 'elevesParExercice'));
}




}
