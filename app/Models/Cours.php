<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $table = 'cours';

    protected $fillable = [
        'id_enseignant',
        'id_matiere',
        'id_annee_scolaire',
        'titre',
        'contenu',
        'fichier',
    ];

    // Relations

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee_scolaire');
    }

    public function ressources()
    {
        return $this->hasMany(Ressource::class, 'id_cours');
    }

    public function devoirs()
    {
        return $this->hasMany(Devoir::class, 'id_cours');
    }
    public function classeTrouvee()
{
    if (!$this->enseignant || !$this->matiere) {
        return null;
    }

    return $this->enseignant->classes()
        ->whereHas('matieres', function($q) {
            $q->where('matieres.id', $this->id_matiere);
        })
        ->first();
}

    public function classesDisponibles()
{
    if (!$this->enseignant || !$this->matiere) {
        return collect();
    }

    return $this->enseignant->classes()->whereHas('matieres', function($q) {
        $q->where('matieres.id', $this->id_matiere);
    })->get();
}

}
