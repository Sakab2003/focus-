<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = 'annee_scolaires';

    protected $fillable = [
        'created_by',
        'libelle',
        'date_debut',
        'date_fin',
        'active',
    ];

    // L'année scolaire appartient à un utilisateur (admin)
    public function creator()
    {
        return $this->belongsTo(Utilisateur::class, 'created_by');
    }

    // Une année scolaire a plusieurs classes
   
    public function cours()
{
    return $this->hasMany(Cours::class, 'id_annee_scolaire');
}
// Dans AnneeScolaire.php
public function getActiveAttribute()
{
    $today = now()->toDateString();
    return $today >= $this->date_debut && $today <= $this->date_fin;
}


}

