<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    public function liste_etudiant()
    {
        $etudiants = Etudiant::paginate(8);
        return view ('etudiant.liste', compact('etudiants'));
    }

    public function ajouter_etudiant()
    {
        return view('etudiant.ajouter');
    }

 public function ajouter_etudiant_traitement(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'classe' => 'required',
    ]);

    $etudiant = new Etudiant();
    $etudiant->nom = $request->nom;
    $etudiant->prenom = $request->prenom;
    $etudiant->classe = $request->classe;
    $etudiant->save(); // N'oubliez pas de sauvegarder !

    return redirect('/ajouter')->with('status', 'L\'Étudiant ajouté avec succès !');
}
public function update_etudiant($id){
    $etudiants = Etudiant::find($id);

    return view('etudiant.update', compact('etudiants'));
}

public function update_etudiant_traitement(Request $request){
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'classe' => 'required',
    ]);
    $etudiant = Etudiant::find($request->id);
    $etudiant->nom = $request->nom;
    $etudiant->prenom = $request->prenom;
    $etudiant->classe = $request->classe;
    $etudiant->update(); // N'oubliez pas de sauvegarder !
    return redirect('/etudiant')->with('status', 'L\'Étudiant a été modifié avec succès !');

}
public function delete_etudiant($id){
    $etudiant = Etudiant::find($id);
    $etudiant->delete();
    return redirect('/etudiant')->with('status', 'L\'Étudiant a été supprimer avec succès !');

}
}
