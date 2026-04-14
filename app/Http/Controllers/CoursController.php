<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    // Liste des cours pour l'enseignant connecté
    public function index()
    {
        $enseignant = Auth::user()->enseignant;

        $cours = Cours::with(['matiere', 'anneeScolaire'])
            ->where('id_enseignant', $enseignant->id)
            ->latest()
            ->get();

        return view('enseignant.liste_cours', compact('cours'));
    }
    

    // Formulaire d'ajout
    public function create()
    {
        $enseignant = Auth::user()->enseignant;

        // Récupérer uniquement les matières que l'enseignant peut enseigner
        $matieres = $enseignant->matieres;

        $annees = AnneeScolaire::all();

        return view('enseignant.ajoutcours', compact('matieres', 'annees'));
    }

    // Enregistrement du cours
    public function cours_ajout_traitement(Request $request)
{
    // Validation
    $request->validate([
        'id_classe' => 'required|exists:classe_virtuelles,id', // on valide quand même que la classe choisie existe
        'id_matiere' => 'required|exists:matieres,id',
        'annee_scolaire' => ['required', 'regex:/^\d{4}-\d{4}$/'],
        'titre' => 'required|string|max:255',
        'contenu' => 'nullable|string',
        'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240'
    ]);
    $annee = AnneeScolaire::where('libelle', $request->annee_scolaire)->first();

if (!$annee) {
    return back()->withErrors([
        'annee_scolaire' => 'Cette année scolaire n’existe pas.'
    ])->withInput();
}


    // Récupérer l'enseignant connecté
    $enseignant = auth()->user()->enseignant;

    // Création du cours
    $cours = new Cours();
    $cours->id_enseignant = $enseignant->id;
    $cours->id_matiere = $request->id_matiere;
    $cours->id_annee_scolaire = $annee->id;
    $cours->titre = $request->titre;
    $cours->contenu = $request->contenu;

    // Gestion du fichier si présent
    if ($request->hasFile('fichier')) {

    $file = $request->file('fichier');

    if (!$file->isValid()) {
        return back()->withErrors(['fichier' => 'Fichier invalide']);
    }

    $path = public_path('uploads/cours');

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move($path, $filename);

    // IMPORTANT: garder le chemin complet
    $cours->fichier = 'uploads/cours/' . $filename;
}

    $cours->save();

    // Ici, tu peux créer la relation avec la classe choisie via un pivot (si tu crées classe_cours)
    // Exemple :
    // $cours->classes()->attach($request->id_classe);

    return redirect()->route('cours.liste')->with('success', 'Cours ajouté avec succès !');
}

    // Formulaire d'édition
    public function edit($id)
    {
        $enseignant = Auth::user()->enseignant;
        // Récupérer toutes les classes de l'enseignant
        $classes = auth()->user()->enseignant->classes;
        $cours = Cours::where('id_enseignant', $enseignant->id)->findOrFail($id);
        $matieres = $enseignant->matieres;
        $annees = AnneeScolaire::all();
        $cours->classe = $enseignant->classes()
    ->whereHas('matieres', function($q) use ($cours) {
        $q->where('matieres.id', $cours->id_matiere);
    })->first();

        return view('enseignant.cours.edit', compact('cours', 'matieres','classes', 'annees'));
    }

    public function getClasseAttribute()
{
    return $this->classeTrouvee();
}
    // Mise à jour
    public function update(Request $request, $id)
    {
        $enseignant = Auth::user()->enseignant;
        $cours = Cours::where('id_enseignant', $enseignant->id)->findOrFail($id);

        $request->validate([
            'id_matiere' => 'required|exists:matieres,id',
            'id_annee_scolaire' => 'required|exists:annee_scolaires,id',
            'titre' => 'required|string|max:255',
            'contenu' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        // Gestion du fichier
        if ($request->hasFile('fichier')) {
            if ($cours->fichier) {
                Storage::delete('public/cours/' . $cours->fichier);
            }
            $fichier = $request->file('fichier');
            $fichierName = time() . '_' . $fichier->getClientOriginalName();
            $fichier->storeAs('public/cours', $fichierName);
            $cours->fichier = $fichierName;
        }

        $cours->update([
            'id_matiere' => $request->id_matiere,
            'id_annee_scolaire' => $request->id_annee_scolaire,
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('cours.liste')
            ->with('success', 'Cours mis à jour avec succès.');
    }

    // Suppression
    public function destroy($id)
    {
        $enseignant = Auth::user()->enseignant;
        $cours = Cours::where('id_enseignant', $enseignant->id)->findOrFail($id);

        if ($cours->fichier) {
            Storage::delete('public/cours/' . $cours->fichier);
        }

        $cours->delete();

        return redirect()->route('cours.liste')
    ->with('success', 'Cours supprimé avec succès.');
    }
    public function cours_liste()
{
    $enseignant = Auth::user()->enseignant; // Récupère l'enseignant lié à l'utilisateur

    if (!$enseignant) {
        abort(403, 'Vous n’êtes pas identifié comme enseignant.');
    }

    // Récupère tous les cours liés à cet enseignant
    $cours = Cours::where('id_enseignant', $enseignant->id)->get();

    return view('enseignant.listecours', compact('cours'));
}
public function show($id)
{
    $cours = Cours::with(['matiere', 'anneeScolaire', 'enseignant'])->findOrFail($id);

    // Récupérer la classe correspondante via la table pivot
    if ($cours->enseignant && $cours->matiere) {
        $cours->classe = $cours->enseignant->classes()->whereHas('matieres', function($q) use ($cours) {
            $q->where('matieres.id', $cours->id_matiere);
        })->first();
    } else {
        $cours->classe = null;
    }

    return view('enseignant.cours.show', compact('cours'));
}

}
