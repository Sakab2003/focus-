<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasseVirtuelle extends Model
{
    protected $table = 'classe_virtuelles';

    protected $fillable = ['name', 'id_utilisateur', 'salle_id'];

    public function salle()
    {
        return $this->belongsTo(SalleClasse::class, 'salle_id');
    }

    public function enseignants()
{
    return $this->belongsToMany(
        Enseignant::class,  // ou Utilisateur::class selon ce que tu veux
        'enseignant_classe', // <-- le nom exact de ta table pivot
        'classe_id',         // clé étrangère pour la classe dans la table pivot
        'enseignant_id'      // clé étrangère pour l’enseignant dans la table pivot
    );
}


    public function matieres()
{
    return $this->belongsToMany(
        Matiere::class,        // modèle Matiere
        'classe_matiere',      // table pivot à créer
        'classe_id',           // clé de classe dans la table pivot
        'matiere_id'           // clé de matière dans la table pivot
    );
}
public function eleves()
    {
        return $this->hasMany(Eleve::class, 'id_classe', 'id');
    }

}






