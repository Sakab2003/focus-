<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'total_classes' => ClasseVirtuelle::count(),
            'total_matieres' => Matiere::count(),
            'total_utilisateurs' => Utilisateur::count(),
            'total_cours' => Cours::count(),
            'total_enseignants' => Utilisateur::where('role', 'enseignant')->count(),
'total_eleves' => Utilisateur::where('role', 'eleve')->count(),
        ]);
    }
}
