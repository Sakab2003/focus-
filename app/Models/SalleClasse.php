<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleClasse extends Model
{
    use HasFactory;

    protected $table = 'salle_classes';

    protected $fillable = [
        'nom',
        'code',
        'max_enseignants',
    ];
    public function enseignants()
{
    return $this->belongsToMany(Enseignant::class, 'enseignant_salle_classe');
}
public function classesVirtuelles()
    {
        return $this->hasMany(ClasseVirtuelle::class, 'salle_id');
    }
}
