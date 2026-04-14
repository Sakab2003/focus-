<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;

class AproposController extends Controller
{
    public function index()
    {
        $classes = ClasseVirtuelle::with('matieres', 'enseignants')->get();

        $total_classes = ClasseVirtuelle::count();
        // Extraire toutes les matières disponibles
         // Récupérer toutes les matières liées aux classes
        $matieresDisponibles = Matiere::whereHas('cours')->get();

        $total_cours = $classes->sum(
            fn($classe) => $classe->matieres->count()
        );

        $total_enseignants = Enseignant::count();

        $total_eleves = Eleve::count();

        return view('apropos', compact(
            'classes',
            'total_classes',
            'total_cours',
            'total_enseignants',
            'total_eleves',
            'matieresDisponibles'
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
}
