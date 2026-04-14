<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use Illuminate\Http\Request;
use App\Models\ReponseExercice;
use Illuminate\Support\Facades\Auth;

class ReponseExerciceController extends Controller
{
    public function form($id)
    {
        $exercice = Exercice::findOrFail($id);
        return view('parent.traiter_exercice', compact('exercice'));
    }

    public function store(Request $request, $id)
{
    $request->validate([
        'reponse_texte' => 'nullable|string',
        'reponse_fichier' => 'nullable|file|max:4096'
    ]);

    $exercice = Exercice::findOrFail($id);

    // Parent connecté
    $parentId = Auth::user()->id_utilisateur;

    // Élève lié à ce parent ET à cette classe
    $eleve = \App\Models\Eleve::where('id_parent', $parentId)
                              ->where('id_classe', $exercice->id_classe)
                              ->first();

    if (!$eleve) {
        return back()->with('error', 'Aucun élève associé à cet exercice.');
    }

    $data = [
    'id_exercice' => $id,
    'id_parent'   => $parentId,
    'id_eleve'    => $eleve->id_eleve,
    'id_classe'   => $exercice->id_classe,
    'reponse_texte'=> $request->reponse_texte ?? null,
    'reponse_fichier' => $request->hasFile('reponse_fichier') 
                        ? $request->file('reponse_fichier')->store('reponses','public') 
                        : null,
];

    if ($request->filled('reponse_texte')) {
        $data['reponse_texte'] = $request->reponse_texte;
    }

    if ($request->hasFile('reponse_fichier')) {
        $data['reponse_fichier'] =
            $request->file('reponse_fichier')->store('reponses', 'public');
    }
    ReponseExercice::create($data);

    return redirect('/parent/exercice')
        ->with('status', 'Votre réponse a été envoyée avec succès.');
}


}
