<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Le__Parent extends Model
{
    protected $table = 'le__parents';
    protected $fillable = ['nom', 'prenom', 'telephone','id_utilisateur'];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'id_parent', 'id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id');
    }
}
