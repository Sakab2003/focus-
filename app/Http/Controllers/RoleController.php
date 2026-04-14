<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Enseignant;
use App\Models\Le__Parent;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Affiche tous les utilisateurs avec leur rôle
    public function index()
    {
        
        $users = Utilisateur::with('roleRelation')->paginate(10);
        $roles = Role::all();
        return view('admin.roles.index', compact('users', 'roles'));
    }

    // Modifier le rôle d’un utilisateur
    public function updateRole(Request $request, Utilisateur $user)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:utilisateurs,email,' . $user->id,
        'role_id' => 'required|exists:roles,id',
        'password' => 'nullable|string|confirmed|min:8', // nullable pour rendre optionnel
    ]);

    if ($user->roleRelation?->Nom === 'Administrateur') {
        return redirect()->back()
            ->with('error', 'Impossible de modifier le rôle d’un administrateur.');
    }

    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    $user->id_role = $request->role_id;

    // Mettre à jour le mot de passe seulement si rempli
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.roles.index')
                     ->with('success', 'Utilisateur mis à jour avec succès.');
}


    // Supprimer un utilisateur (sauf admin)
    public function destroy(Utilisateur $user)
    {
        if ($user->roleRelation?->Nom === 'Administrateur') {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer un administrateur.');
        }

        $user->delete();

        return redirect()->back()
            ->with('success', 'L\'utilisateur a été supprimé avec succès.');
    }
    public function show(Utilisateur $user)
{
    return view('admin.roles.show', compact('user'));
}


public function edit(Utilisateur $user)
{
    $roles = Role::all(); // ← charger les rôles
    return view('admin.roles.edit', compact('user', 'roles'));
}
public function create()
{
    $roles = Role::all(); // récupère tous les rôles

    return view('admin.roles.create', compact('roles'));
}

public function store(Request $request)
{
    // 🔹 Normaliser l’email (évite les doublons Gmail / casse)
    $request->merge([
        'email' => strtolower($request->email),
    ]);

    $request->validate([
        'nom'       => 'required|string|max:255',
        'prenom'    => 'required|string|max:255',
        'email'     => 'required|email|unique:utilisateurs,email',
        'password'  => 'required|string|confirmed|min:6',
        'role_id'   => 'required|exists:roles,id',
    ]);

    DB::transaction(function () use ($request) {

        // 🔹 Récupérer le rôle
        $role = Role::findOrFail($request->role_id);

        // 🔹 Créer l’utilisateur
        $user = Utilisateur::create([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'id_role'  => $role->id,
            'role'     => strtolower($role->Nom),
        ]);

        // 🔹 Créer la relation selon le rôle
        if (strtolower($role->Nom) === 'enseignant') {

            Enseignant::firstOrCreate(
                ['email' => $user->email],   // clé UNIQUE
                [
                    'id_utilisateur' => $user->id,
                    'nom'            => $user->nom,
                    'prenom'         => $user->prenom,
                ]
            );

        } elseif (strtolower($role->Nom) === 'parent') {

            Le__Parent::firstOrCreate(
                ['id_utilisateur' => $user->id],
                [
                    'nom'    => $user->nom,
                    'prenom' => $user->prenom,
                ]
            );
        }
    });

    return redirect()
        ->route('admin.roles.index')
        ->with('success', 'Utilisateur créé avec succès et relation générée.');
}




}
