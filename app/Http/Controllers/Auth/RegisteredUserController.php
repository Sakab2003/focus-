<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->merge([
    'email' => strtolower($request->email)
]);
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Utilisateur::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:parent,enseignant,administrateur'], 
    ]);

    $user = Utilisateur::create([
        'nom' => $request->name,
        'prenom' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, 
    ]);

    // Si c'est le premier utilisateur, on le rend administrateur
    if (Utilisateur::count() === 1) {
        $user->role = 'administrateur';
        $user->save();
    }

    Auth::login($user);
    event(new Registered($user));

    return match($user->role) {
        'parent' => redirect()->route('parent.dashboard'),
        'enseignant' => redirect()->route('enseignant.dashboard'),
        'administrateur' => redirect()->route('admin.dashboard'),
        default => redirect()->route('dashboard'),
    };
}

}
