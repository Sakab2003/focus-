<?php

namespace App\Observers;

use App\Models\Utilisateur;
use App\Models\Enseignant;
use App\Models\Le__Parent;


class UtilisateurObserver
{
    public function created(Utilisateur $utilisateur)
    {
        // =====================
        // CAS ENSEIGNANT
        // =====================
        if ($utilisateur->role === 'enseignant') {

            Enseignant::firstOrCreate(
                [
                    'id_utilisateur' => $utilisateur->id
                ],
                [
                    'nom' => $utilisateur->nom,
                    'prenom' => $utilisateur->prenom ?? $utilisateur->nom,
                    'email' => $utilisateur->email,
                    'telephone' => null,
                ]
            );
        }

        // =====================
        // CAS PARENT
        // =====================
        elseif ($utilisateur->role === 'parent') {

            Le__Parent::firstOrCreate(
                [
                    'id_utilisateur' => $utilisateur->id
                ],
                [
                    'nom' => $utilisateur->nom,
                    'prenom' => $utilisateur->prenom ?? $utilisateur->nom,
                ]
            );
        }
    }
    
}