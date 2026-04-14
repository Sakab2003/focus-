<?php

namespace App\Http\Controllers;

use App\Models\ClasseVirtuelle;
use App\Models\SalleClasse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Enseignant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClasseVirtuelle::latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    /* =========================
        CREATE : formulaire
    ========================== */
    public function create()
    {
        return view('admin.classes.create');
    }

    /* =========================
        STORE : enregistrement
    ========================== */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'max_enseignants' => 'required|integer|min:1|max:100',
        ]);

        ClasseVirtuelle::create([
            'nom' => $request->nom,
            'max_enseignants' => $request->max_enseignants,
            'code' => 'CLS-' . strtoupper(Str::random(6)),
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Salle de classe créée avec succès');
    }

    /* =========================
        SHOW : voir une classe
    ========================== */
    public function show($id)
    {
        $classe = ClasseVirtuelle::findOrFail($id);
        return view('admin.classes.show', compact('classe'));
    }

    /* =========================
        EDIT : formulaire édition
    ========================== */
    public function edit($id)
    {
        $classe = ClasseVirtuelle::findOrFail($id);
        return view('admin.classes.edit', compact('classe'));
    }

    /* =========================
        UPDATE : mise à jour
    ========================== */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'max_enseignants' => 'required|integer|min:1|max:100',
        ]);

        $classe = ClasseVirtuelle::findOrFail($id);

        $classe->update([
            'nom' => $request->nom,
            'max_enseignants' => $request->max_enseignants,
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Salle de classe modifiée avec succès');
    }

    /* =========================
        DESTROY : suppression
    ========================== */
    public function destroy($id)
    {
        ClasseVirtuelle::findOrFail($id)->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Salle de classe supprimée');
    }


    public function classe_liste()
{
    $enseignant = Enseignant::where('id_utilisateur', auth()->id())
        ->with(['classes.salle', 'classes.matieres'])
        ->firstOrFail();

    return view('enseignant.liste_classe', compact('enseignant'));
}


public function confirmDelete($id)
{
    $classe = ClasseVirtuelle::findOrFail($id);
    return view('enseignant.classe.destroy', compact('classe'));
}

}
