<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_year',
        'code',
        'max_teachers',
        'id_utilisateur',
    ];

    // Génération automatique du code matière
    public static function generateCode(string $name): string
    {
        return 'MAT-' . strtoupper(substr($name, 0, 3)) . '-' . rand(1000, 9999);
    }

    // Admin propriétaire
    public function admin()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
    public function enseignants()
{
    return $this->belongsToMany(
        Enseignant::class,
        'enseignant_matiere',
        'matiere_id',
        'enseignant_id'
    );
}
public function classes()
    {
        return $this->belongsToMany(ClasseVirtuelle::class, 'classe_matiere', 'matiere_id', 'classe_id');
    }
    public function cours()
{
    return $this->hasMany(Cours::class, 'id_matiere');
}


}
