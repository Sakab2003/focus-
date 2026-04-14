<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignants';
    protected $fillable = ['nom', 'prenom', 'email', 'id_utilisateur', 'telephone', 'photo', 'bibliographie'];


    public function utilisateur() {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function classes()
{
    // 'id_utilisateur' dans classe_virtuelles correspond à l'id de l'utilisateur enseignant
    return $this->hasMany(ClasseVirtuelle::class, 'id_utilisateur', 'id_utilisateur');
}


    // Relation avec les matières
    public function matieres()
{
    return $this->belongsToMany(
        Matiere::class,
        'enseignant_matiere', // table pivot
        'enseignant_id',      // clé côté Enseignant
        'matiere_id'          // clé côté Matiere
    );
}

public function salles()
{
    return $this->belongsToMany(SalleClasse::class, 'enseignant_salle_classe');
}
}

