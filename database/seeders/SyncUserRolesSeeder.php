<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Database\Seeder;

class SyncUserRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all()->keyBy('Nom');

        Utilisateur::whereNull('id_role')->each(function ($user) use ($roles) {
            if (isset($roles[$user->role])) {
                $user->id_role = $roles[$user->role]->id;
                $user->save();
            }
        });
    }
}
