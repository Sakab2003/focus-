<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnneeScolaireController extends Controller
{
    // Liste des années scolaires
    public function index()
{
    $annees = AnneeScolaire::orderBy('libelle', 'desc')->get(); // plus besoin de 'with('cours')' ici si tu n'affiches que l'année
    return view('admin.annee.index', compact('annees'));
}

    // Formulaire pour créer
    public function create()
    {
        return view('admin.annee.create');
    }

    // Stockage en base
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|unique:annee_scolaires,libelle',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        AnneeScolaire::create([
            'created_by' => auth()->id(),
            'libelle' => $request->libelle,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('admin.annee.index')->with('success', 'Année scolaire ajoutée avec succès.');
    }




    // Afficher une année scolaire et ses classes
    public function show(AnneeScolaire $annee)
{
    $annee->load('cours.enseignant'); // charge uniquement les cours et leur enseignant
    return view('admin.annee.show', compact('annee'));
}


    // Formulaire édition
    public function edit(AnneeScolaire $annee)
    {
        return view('admin.annee.edit', compact('annee'));
    }

    // Mise à jour
    public function update(Request $request, AnneeScolaire $annee)
    {
        $request->validate([
            'libelle' => 'required|unique:annee_scolaires,libelle,' . $annee->id,
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $annee->update([
            'libelle' => $request->libelle,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('admin.annee.index')->with('success', 'Année scolaire mise à jour.');
    }

    // Supprimer une année scolaire
    public function destroy(AnneeScolaire $annee)
    {
        $annee->delete();
        return redirect()->route('admin.annee.index')->with('success', 'Année scolaire supprimée.');
    }
}
