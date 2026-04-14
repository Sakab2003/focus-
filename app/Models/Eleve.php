<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $table = 'eleves';
    protected $fillable = ['nom', 'prenom', 'id_parent', 'id_classe','id_enseignant'];

    public function parent()
    {
        return $this->belongsTo(Le__Parent::class, 'id_parent', 'id');
    }

    public function classe()
    {
        return $this->belongsTo(ClasseVirtuelle::class, 'id_classe');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'id_eleve');
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }
public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'eleve_matiere', 'eleve_id', 'matiere_id');
    }


} 

