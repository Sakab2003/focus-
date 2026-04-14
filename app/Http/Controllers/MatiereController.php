<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::latest()->get();
        return view('admin.matieres.index', compact('matieres'));
    }

    public function create()
    {
        return view('admin.matieres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'],
        ]);

        Matiere::create([
            'name' => $request->name,
            'school_year' => $request->school_year,
            'code' => Matiere::generateCode($request->name),
            'max_teachers' => 10,
            'id_utilisateur' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.matieres.index')
            ->with('success', 'Matière créée avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
{
    return view('admin.matieres.show', compact('matiere'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
{
    return view('admin.matieres.edit', compact('matiere'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_year' => ['required', 'regex:/^\d{4}-\d{4}$/'],
        ]);

        $matiere->update([
            'name' => $request->name,
            'school_year' => $request->school_year,
        ]);

        return redirect()
            ->route('admin.matieres.index')
            ->with('success', 'Matière modifiée avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $matiere = Matiere::findOrFail($id);
    $matiere->delete();

    return redirect()
        ->route('admin.matieres.index')
        ->with('success', 'Matière supprimée avec succès');
}
    

    public function matiere_liste()
    {
        // Récupération des cours
        $classes = Matiere::all();

        // Envoi des données à la vue
        return view('matieres.liste_classe', compact('matieres'));
    }
    public function ajout_classe_traitement(Request $request)
{
    $enseignant = auth()->user()->enseignant;

    if (!$enseignant) {
        return back()->withErrors([
            'enseignant' => 'Aucun enseignant associé à ce compte.'
        ]);
    }

    $request->validate([
        'niveau' => 'required|string|in:CP1,CP2,CE1,CE2,CM1,CM2',
        'matieres' => 'required|array',
        'matieres.*' => 'string',
    ]);

    Matiere::create([
        'id_enseignant'   => $enseignant->id_enseignant,
        'nom_professeur'  => $enseignant->nom,
        'prenom_professeur' => $enseignant->prenom,
        'niveau'          => $request->niveau,
        'matieres'        => $request->matieres, // cast JSON
    ]);

    return redirect()
        ->route('matieres.liste')
        ->with('status', 'La matiere a bien été ajoutée.');
}

public function classesParNiveauEnseignant($niveau)
{
    $enseignantId = Auth::user()->enseignant->id_enseignant;

    $matieres = Matiere::where('niveau', $niveau)
        ->where('id_enseignant', $enseignantId)
        ->get();

    return response()->json($matieres);
}
public function confirmDelete($id)
{
    $matieres = Matiere::findOrFail($id);
    return view('admin.matieres.destroy', compact('matieres'));
}

}
