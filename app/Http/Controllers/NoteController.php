<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Eleve;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;
use App\Models\ReponseExercice;
use App\Models\ResponseExercice;
use App\Models\Enseignant;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    // récupérer l'enseignant lié à l'utilisateur connecté
    $enseignant = Enseignant::where('id_utilisateur', $user->id)->first();

    $notes = Note::with([
        'eleve.classe',
        'devoir.cours.matiere',
        'devoir.cours.enseignant',
    ])
    ->whereHas('devoir.cours', function ($q) use ($enseignant) {
        $q->where('id_enseignant', $enseignant->id);
    })
    ->latest()
    ->get();

    return view('enseignant.notes.index', compact('notes', 'enseignant'));
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
    public function edit(Note $note)
{
    
     $this->checkOwnership($note);

    return view('enseignant.notes.edit', compact('note'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
{
    $request->validate([
        'valeur' => 'required|numeric|min:0|max:20',
        'remarque' => 'nullable|string',
    ]);

    $note->update([
        'valeur' => $request->valeur,
        'remarque' => $request->remarque,
    ]);

    return redirect()
        ->route('enseignant.notes.index')
        ->with('success', 'Note modifiée avec succès');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
{
    $note->delete();

    return redirect()
        ->route('enseignant.notes.index')
        ->with('success', 'Note supprimée avec succès');
}
    public function notes_liste(Request $request)
{
    $user = auth()->user();

    if (!$user || !$user->enseignant) {
        abort(403, 'Accès réservé aux enseignants');
    }

    $enseignantId = $user->enseignant->id; // ou id_enseignant selon ta table

    $classes = ClasseVirtuelle::where('id_utilisateur', $enseignantId)->get();

    return view('enseignant.listenotes', [
        'classes' => $classes,
        'notes' => collect(),
        'elevesNonEnvoye' => collect(),
    ]);
}
private function checkOwnership(Note $note)
    {
        $enseignantId = auth()->user()
            ->enseignant
            ->id;

        abort_if(
            $note->devoir->cours->id_enseignant !== $enseignantId,
            403,
            "Accès refusé"
        );
    }
}


