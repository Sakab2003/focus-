<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'Nom',
        'Description',
    ];

    // Un rôle peut avoir plusieurs utilisateurs
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_role');
    }
    protected static function booted()
    {
        if (self::count() === 0) {
            self::insert([
                ['Nom' => 'Administrateur', 'Description' => 'Admin'],
                ['Nom' => 'Enseignant', 'Description' => 'Professeur'],
                ['Nom' => 'Parent', 'Description' => 'Parent'],
            ]);
        }
    }
}
