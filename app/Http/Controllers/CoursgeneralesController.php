<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Devoir;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class CoursgeneralesController extends Controller
{
    public function index_parent()
{
    $parent = Auth::user()->parent;

    // Récupérer les IDs des élèves
    $eleveIds = $parent->eleves()->pluck('id');

    // Récupérer les IDs des classes des élèves
    $classeIds = \App\Models\Eleve::whereIn('id', $eleveIds)
        ->pluck('id_classe')
        ->unique();

    $total_classes = $classeIds->count();

    // Récupérer les IDs des matières associées à ces classes
    $matiereIds = \Illuminate\Support\Facades\DB::table('classe_matiere')
        ->whereIn('classe_id', $classeIds)
        ->pluck('matiere_id')
        ->unique();

    $total_cours = \App\Models\Cours::whereIn('id_matiere', $matiereIds)->count();

    $total_enseignants = \App\Models\Cours::whereIn('id_matiere', $matiereIds)
        ->distinct('id_enseignant')
        ->count('id_enseignant');

    $total_eleves = $parent->eleves()->count();

    // Récupérer tous les cours pour afficher dans le tableau
$cours = Cours::with(['enseignant','matiere'])->get();


// Ajouter manuellement la classe associée à chaque cours
foreach ($cours as $c) {

    $classeIdsMatiere = DB::table('classe_matiere')
        ->where('matiere_id', $c->id_matiere)
        ->pluck('classe_id');

    $c->classe = ClasseVirtuelle::whereIn('id', $classeIdsMatiere)->get();
}



    return view('coursgenerales.index_parent',compact(
        'total_classes',
        'total_cours',
        'total_enseignants',
        'total_eleves',
        'cours' // <-- il faut passer cette variable
    ));
}
public function show_parent($id)
{
    $cours = Cours::with(['enseignant','matiere'])
        ->findOrFail($id);

    // récupérer les classes liées à la matière
    $classeIds = DB::table('classe_matiere')
        ->where('matiere_id', $cours->id_matiere)
        ->pluck('classe_id');

    $cours->classe = ClasseVirtuelle::whereIn('id', $classeIds)->get();

    return view('coursgenerales.show_parent', compact('cours'));
}


public function download_contenu($id)
{
    $cours = Cours::findOrFail($id);

    if (empty($cours->contenu)) {
        abort(404, "Aucun contenu disponible.");
    }

    $pdf = Pdf::loadView('coursgenerales.pdf_contenu', compact('cours'));

    return $pdf->download($cours->titre . '.pdf');
}

public function download_fichier($id)
{
    $cours = Cours::findOrFail($id);

    if (empty($cours->fichier)) {
        abort(404, "Aucun fichier disponible.");
    }

    $path = public_path('uploads/cours/' . $cours->fichier);

    if (!file_exists($path)) {
        abort(404, "Fichier introuvable.");
    }

    return response()->download($path);
}


public function index_enseignant()
{
    // Données de base
        $messages = [];
        $notifications = [];

        $user = Auth::user();
        $enseignant = $user->enseignant;

        if (!$enseignant) {
            abort(403, 'Aucun enseignant associé à ce compte');
        }

        // ✅ CLASSES DE L’ENSEIGNANT (via table pivot enseignant_classe)
        $classes = ClasseVirtuelle::with('salle')
            ->whereHas('enseignants', function ($q) use ($enseignant) {
                $q->where('enseignants.id', $enseignant->id);
            })
            ->get();

        $classeIds = $classes->pluck('id');

        // ✅ COURS DE L’ENSEIGNANT (lien direct)
        $total_cours = Cours::where('id_enseignant', $enseignant->id)->count();

        // ✅ DEVOIRS DE SES COURS
        $total_devoirs = Devoir::whereHas('cours', function ($q) use ($enseignant) {
            $q->where('id_enseignant', $enseignant->id);
        })->count();

        // ✅ NOMBRE DE CLASSES
        $total_classes = $classes->count();

        // ✅ ÉLÈVES DES CLASSES DE L’ENSEIGNANT
        $total_eleves = Eleve::whereIn('id_classe', $classeIds)->count();
        $matiereIds = \Illuminate\Support\Facades\DB::table('classe_matiere')
    ->whereIn('classe_id', $classeIds)
    ->pluck('matiere_id')
    ->unique();
        $cours = Cours::with(['enseignant','matiere'])->get();

    $eleveIds = Eleve::whereIn('id_classe', $classeIds)->pluck('id');


// Ajouter manuellement la classe associée à chaque cours
foreach ($cours as $c) {

    $classeIdsMatiere = DB::table('classe_matiere')
        ->where('matiere_id', $c->id_matiere)
        ->pluck('classe_id');

    $c->classe = ClasseVirtuelle::whereIn('id', $classeIdsMatiere)->get();
}


        return view('coursgenerales.index_enseignant', compact(
            'messages',
            'notifications',
            'enseignant',
            'classes',
            'total_cours',
            'total_devoirs',
            'total_classes',
            'total_eleves',
            'cours'
        ));
}
public function show_enseignant($id)
{
    $cours = Cours::with(['enseignant','matiere'])
        ->findOrFail($id);

    // récupérer les classes liées à la matière du cours
    $classeIds = DB::table('classe_matiere')
        ->where('matiere_id', $cours->id_matiere)
        ->pluck('classe_id');

    $cours->classe = ClasseVirtuelle::whereIn('id', $classeIds)->get();

    return view('coursgenerales.show_enseignant', compact('cours'));
}

}
