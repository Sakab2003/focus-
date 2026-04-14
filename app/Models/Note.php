<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'id_eleve',
        'id_devoir',
        'valeur',
        'remarque',
        'devoir_traiter',
        'fichier',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function devoir()
    {
        return $this->belongsTo(Devoir::class, 'id_devoir');
    }

}
