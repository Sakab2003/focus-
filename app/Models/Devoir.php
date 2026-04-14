<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    protected $fillable = ['id_cours', 'contenu', 'titre', 'fichier', 'date_limite'];
    public function cours()
{
    return $this->belongsTo(Cours::class, 'id_cours');
}
protected $dates = [
        'date_limite',
        'created_at',
        'updated_at',
    ];
    public function reponses()
    {
        return $this->hasMany(ReponseDevoir::class, 'devoir_id');
    }
    public function notes()
{
    return $this->hasMany(Note::class, 'id_devoir');
}
public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }
public function matiere()
    {
        return $this->hasOneThrough(
            Matiere::class,
            Cours::class,
            'id',         // clé primaire du cours
            'id',         // clé primaire de matiere
            'id_cours',   // clé étrangère de devoir vers cours
            'id_matiere'  // clé étrangère de cours vers matiere
        );
    }
}
