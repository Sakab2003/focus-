<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Eleve;
use App\Models\Devoir;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\ClasseVirtuelle;
use App\Models\Le__Parent;

class AdministrateurController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'total_devoirs'     => Devoir::count(),
            'total_cours'       => Cours::count(),
            'total_parents'     => Le__Parent::count(),
            'total_eleves'      => Eleve::count(),
            'total_enseignants' => Enseignant::count(),
            'total_classes'     => ClasseVirtuelle::count(),
        ]);
    }
}
