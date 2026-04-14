<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'role', 'id_role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function parent()
{
    return $this->hasOne(Le__Parent::class, 'id_utilisateur', 'id');

}

    public function enseignant()
{
    return $this->hasOne(Enseignant::class, 'id_utilisateur');
}



    public function classes_virtuelles()
{
    return $this->hasMany(ClasseVirtuelle::class, 'id_utilisateur');
}

    public function eleves()
{
    return $this->hasManyThrough(
        Eleve::class,
        Le__Parent::class,
        'id_utilisateur', // FK sur le__parents
        'id_parent',      // FK sur eleves
        'id',             // PK utilisateurs
        'id'              // PK le__parents
    );
}

    public function roleRelation()
{
    return $this->belongsTo(Role::class, 'id_role');
}
protected static function booted()
{
    // Assigner id_role automatiquement si seulement role est défini
    static::creating(function ($user) {
        if (!$user->id_role && $user->role) {
            $role = \App\Models\Role::where('Nom', $user->role)->first();
            if ($role) {
                $user->id_role = $role->id;
            }
        }
    });

    // Synchroniser le champ role avec la relation
    static::saving(function ($user) {
        if ($user->roleRelation) {
            $user->role = $user->roleRelation->Nom;
        }
    });

    // Créer automatiquement la relation parent/enseignant après création
    static::created(function ($user) {
        // 🔑 Recharge la relation roleRelation
        $user->load('roleRelation');
        $roleName = $user->roleRelation->Nom ?? '';

        if ($roleName === 'Enseignant' && !$user->enseignant) {
            \App\Models\Enseignant::create([
                'id_utilisateur' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
            ]);
        } elseif ($roleName === 'Parent' && !$user->parent) {
            \App\Models\Le__Parent::create([
                'id_utilisateur' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
            ]);
        }
    });
}


} 


