<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Devoir;
use Illuminate\Http\Request;

class DevoirController extends Controller
{
    public function index(Cours $cours)
{
    $this->authorizeCours($cours);
    $cours->load('matiere.classes');

    $devoirs = $cours->devoirs;

    return view('enseignant.devoir.index', compact('cours', 'devoirs'));
}

    public function selectCours()
{
    if (auth()->user()->role !== 'enseignant') {
        abort(403);
    }

    $enseignant = auth()->user()->enseignant;

    $cours = Cours::where('id_enseignant', $enseignant->id)->get();
    return view('enseignant.devoir.select-cours', compact('cours'));
}

public function store(Request $request, Cours $cours)
{
    $this->authorizeCours($cours);

    $request->validate([
        'titre'       => 'required|string|max:255',
        'contenu'     => 'nullable|string',
        'date_limite' => 'required|date',
        'fichier'     => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
    ]);

    // Gestion du fichier
    $fichier = null;
    if ($request->hasFile('fichier')) {
        $fichier = $request->file('fichier')
            ->store('devoirs', 'public');
    }

    $cours->devoirs()->create([
        'titre'       => $request->titre,
        'contenu'     => $request->contenu,
        'date_limite' => $request->date_limite,
        'fichier'     => $fichier,
    ]);

    return redirect()
        ->route('enseignant.devoir.index', $cours->id)
        ->with('success', 'Devoir ajouté avec succès !');
}

private function authorizeCours(Cours $cours)
{
    if ($cours->id_enseignant !== auth()->user()->enseignant->id) {
        abort(403);
    }
}
public function create(Cours $cours)
{
    $devoirs = $cours->devoirs;
    $this->authorizeCours($cours);
    return view('enseignant.devoir.create', compact('cours', 'devoirs'));
}
public function show(Devoir $devoir)
{
    $cours = Cours::find($devoir->id_cours);
    return view('enseignant.devoir.show', compact('devoir', 'cours'));
}


public function edit(Devoir $devoir)
{
    $cours = Cours::find($devoir->id_cours); // récupère le cours lié
    return view('enseignant.devoir.edit', compact('devoir', 'cours'));
}


public function update(Request $request, Devoir $devoir)
{
    $request->validate([
        'titre'       => 'required|string',
        'contenu'     => 'nullable|string',
        'date_limite' => 'required|date',
    ]);

    $devoir->update([
        'titre'       => $request->titre,
        'contenu'     => $request->contenu,
        'date_limite' => $request->date_limite,
    ]);

    return redirect()
        ->route('enseignant.devoir.index', $devoir->id_cours)
        ->with('success', 'Devoir modifié avec succès !');
}

public function destroy(Devoir $devoir)
{
    $coursId = $devoir->id_cours;
    $devoir->delete();
    return redirect()->route('enseignant.devoir.index', $coursId)
                     ->with('success', 'Devoir supprimé avec succès !');
}


}
