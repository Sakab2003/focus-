<?php

use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Utilisateur;
use App\Models\ClasseVirtuelle;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\CoursgeneralesController;
use App\Http\Controllers\DevoirController;
use App\Http\Controllers\ReponseExerciceController;



Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/apropos', [AproposController::class, 'index']);

Route::get('/dashboard2', function () {
    return view('dashboard2');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/layouts/acceuil', function () {
    return view('layouts.acceuil');
});

Route::get('/enseignant/devoir/index', [DevoirController::class, 'index'])->name('devoir.index');
/*Route::get('/profile/welcome1', function () {
    $enseignants = Enseignant::all();
    return view('welcome1', compact('enseignants'));
});*/
Route::middleware(['auth'])->group(function () {
    Route::get('/parent/dashboard', function () {
        return view('parent.dashboard');
    })->name('parent.dashboard');
/*
Route::get('/enseignant/dashboard', function () {
        return view('enseignant.dashboard');
    })->name('enseignant.dashboard');*/
    Route::get('/enseignant/dashboard', [EnseignantController::class, 'index'])
    ->name('enseignant.dashboard')
    ->middleware('auth');

    Route::middleware(['auth'])
    ->get('/admin/dashboard', [AdministrateurController::class, 'index'])
    ->name('admin.dashboard');});
Route::get('/parent/suivi',[ParentController::class, 'gestion_eleve']); 

Route::get('/parent/conseil', function () {
    return view('parent.conseil');
})->name('conseil.index');
Route::get('/parent/remarque', function () {
    return view('parent.remarque');
})->name('remarque.index');
Route::get('/parent/assiduitee', function () {
    return view('parent.assiduitee');
})->name('assiduitee.index');
Route::get('/parent/comportement', function () {
    return view('parent.comportement');
})->name('comportement.index');

//ajout de classe par l'enseignant
Route::middleware(['auth'])->prefix('enseignant')->group(function() {
    Route::get('/ajout_classe', [EnseignantController::class, 'create'])->name('enseignant.ajout_classe');
    Route::post('/ajout_classe', [EnseignantController::class, 'store'])->name('enseignant.ajout_classe.store');
});
Route::middleware(['auth'])->prefix('enseignant/classe')->name('enseignant.classe.')->group(function () {
    // Actions sur une classe spécifique
    Route::get('/{id}/edit', [EnseignantController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EnseignantController::class, 'update'])->name('update');
    Route::put('/{id}', [EnseignantController::class, 'update_classe_virtuelle'])
    ->name('update.classe.virtuelle');

    Route::delete('/{id}', [EnseignantController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [EnseignantController::class, 'show'])->name('show');
});


/*ici*/


// Pour les parents
Route::get('/parent/eleve/inscription', [EleveController::class, 'create'])->name('eleves.create');
Route::post('/parent/eleve/inscription', [EleveController::class, 'store'])->name('eleves.store');

// Pour les enseignants (ajouter des classes)
Route::get('/enseignant/classes/ajouter', [ClasseController::class, 'create'])->name('classes.create');
Route::get('/parent/eleve/inscription', [ParentController::class, 'inscription_eleve'])->name('classes.store');
Route::get('/parent/layout', function () {
    return view('parent.layout');
});

Route::post('/inscription/traitement', [EleveController::class, 'inscription_eleve_traitement'])->name('eleves.store');
Route::get('/parent/eleve/liste', [EleveController::class, 'liste'])->name('parent.eleve.liste');
Route::get('/parent/devoirs', [EleveController::class, 'listeDevoirs'])
    ->name('parent.devoirs');

Route::get('/update-eleve/{id_eleve}', [EleveController::class, 'update_eleve']);

Route::put('/update/traitement/{id}', [EleveController::class, 'update_eleve_traitement'])->name('eleve.update');
Route::get('/parent/eleve/cours1', [ParentController::class, 'cours1'])->name('classes.create');
Route::get('/parent/eleve/cours2', [ParentController::class, 'cours2'])->name('classes.create');
Route::get('/parent/eleve/cours3', [ParentController::class, 'cours3'])->name('classes.create');
Route::get('/parent/eleve/cours4', [ParentController::class, 'cours4'])->name('classes.create');
Route::get('/parent/eleve/cours5', [ParentController::class, 'cours5'])->name('classes.create');
Route::get('/parent/eleve/cours6', [ParentController::class, 'cours6'])->name('classes.create');
Route::get('/parent/eleve/cours7', [ParentController::class, 'cours7'])->name('classes.create');
Route::get('/parent/eleve/cours8', [ParentController::class, 'cours8'])->name('classes.create');

Route::delete('/delete-eleve/{id}', [EleveController::class, 'delete_eleve'])->name('eleve.delete');
Route::get('/parent/eleve/voir/{id}', [EleveController::class, 'voir'])->name('parent.eleve.voir');

//Route::get('/enseignant/liste_classe', [ClasseController::class, 'liste_enseignant']);
//Route::get('/enseignant/gestion_eleve', [EnseignantController::class, 'gest_eleve']);
Route::get('/enseignant/ajoutcours', [EnseignantController::class, 'cours_ajout']);
Route::get('/enseignant/exercice', [EnseignantController::class, 'exercice_ajout']);

Route::post('/ajoutcours/traitement', [CoursController::class, 'cours_ajout_traitement'])->name('cours.ajout_traitement');
Route::post('/exercice/traitement', [ExerciceController::class, 'exercice_ajout_traitement']);

Route::post('/ajout_classe/traitement', [ClasseController::class, 'ajout_classe_traitement']);

// Pour l'envoie des donnees sur la partie du parent
Route::get('/ajout_classe', [EnseignantController::class, 'index'])
     ->name('enseignant.liste_classe');


Route::get('/parent/eleve/enseignant', [ParentController::class, 'choixEnseignant'])
     ->name('parent.eleve.enseignant');



Route::get('/parent/dashboard', [ParentController::class, 'index'])
    ->name('parent.dashboard')
    ->middleware('auth');
    // Inscription élève (version parent)
Route::get('/inscription', [EleveController::class, 'formInscription'])->name('eleves.form');
Route::post('/inscription/traitement', [EleveController::class, 'inscription_eleve_traitement'])->name('eleves.store');


Route::prefix('enseignant')->name('enseignant.')->middleware('auth')->group(function () {
    Route::resource('messages', MessageController::class);
});
Route::prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
});
Route::get('/enseignant/gestion_eleve', [EnseignantController::class, 'gererEleve'])
    ->name('enseignant.gestion_eleve');

Route::get('/cours/{id}', [CoursController::class, 'show'])
    ->name('cours.show');
Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update');
Route::get('/cours/{id}/edit', [CoursController::class, 'edit'])->name('cours.edit');
Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');
Route::get('/enseignant/listecours', [CoursController::class, 'cours_liste'])->name('cours.liste');

Route::get('/exercice/{id}', [ExerciceController::class, 'show'])
    ->name('exercice.show');
Route::put('/exercice/{id}', [ExerciceController::class, 'update'])->name('exercice.update');
Route::get('/exercice/{id}/edit', [ExerciceController::class, 'edit'])->name('exercice.edit');
Route::delete('/exercice/{id}', [ExerciceController::class, 'destroy'])->name('exercice.destroy');
Route::get('/enseignant/listeexercice', [ExerciceController::class, 'exercice_liste'])->name('exercice.liste');

Route::get('/classe/{id}', [ClasseController::class, 'show'])
    ->name('classe.show');
Route::put('/classe/{id}', [ClasseController::class, 'update'])->name('classe.update');
Route::get('/classe/{id}/edit', [ClasseController::class, 'edit'])->name('classe.edit');
Route::delete('/classe/{id}', [ClasseController::class, 'destroy'])->name('classe.destroy');
Route::get('/enseignant/liste_classe', [ClasseController::class, 'classe_liste'])->name('classe.liste');

Route::get(
    '/enseignant/classes-par-niveau/{niveau}',
    [ClasseController::class, 'classesParNiveauEnseignant']
)->middleware('auth');

Route::get('/classe/{id}/delete', [ClasseController::class, 'confirmDelete'])
    ->name('classe.delete');

// Afficher la liste des cours reçus par le parent
Route::middleware('auth')->group(function () {
    Route::get('/parent/cours', [ParentController::class, 'coursParClasse'])->name('parent.cours');
    Route::get('/parent/cours/{id_classe}', [ParentController::class, 'coursClasse'])->name('parent.cours.classe');
});

Route::middleware('auth')->group(function () {
    Route::get('/parent/exercice', [ExerciceController::class, 'exerciceParClasse'])->name('parent.exercice');
    Route::get('/parent/exercice/{id_classe}', [ExerciceController::class, 'exerciceClasse'])->name('parent.exercice.classe');
});

Route::middleware('auth')->group(function () {
    Route::get('/parent/exercice/{id}/traiter',
        [ReponseExerciceController::class,'form']
    )->name('parent.exercice.traiter');

    Route::post('/parent/exercice/{id}/traiter',
        [ReponseExerciceController::class,'store']
    )->name('parent.exercice.store');
});

Route::get('/enseignant/listenotes', [NoteController::class, 'notes_liste'])->name('notes.liste');
Route::put('/enseignant/note/{id}', [NoteController::class, 'update'])->name('notes.update');
Route::get('/message/envoyer/{id_eleve}', [MessageController::class, 'envoyer'])->name('message.envoyer');

Route::middleware('auth')->group(function () {
Route::get('/enseignant/profile', [EnseignantController::class, 'profile'])
        ->name('enseignant.profile');

Route::post('/enseignant/profile/update', [EnseignantController::class, 'update'])
        ->name('enseignant.profile.update');

        //partie classes admin
Route::get('/admin/classes/index', [ClasseController::class, 'index'])
        ->name('admin.classes.index');

Route::get('/admin/classes/create', [ClasseController::class, 'create'])
            ->name('admin.classes.create');

Route::post('/admin/classes/store', [ClasseController::class, 'store'])
            ->name('admin.classes.store');
Route::get('/classes/{id}/edit', [ClasseController::class, 'edit'])
        ->name('admin.classes.edit');
Route::delete('/admin/classes/{id}', [ClasseController::class, 'destroy'])
        ->name('admin.classes.destroy');
Route::get('/admin/classes/{id}', [ClasseController::class, 'show'])
            ->name('admin.classes.show');
Route::put('/classes/{id}', [ClasseController::class, 'update'])
        ->name('admin.classes.update');

//partie matieres admin
Route::get('/matieres/index', [MatiereController::class, 'index'])
        ->name('admin.matieres.index');

    Route::get('/matieres/create', [MatiereController::class, 'create'])
        ->name('admin.matieres.create');

    Route::post('/matieres', [MatiereController::class, 'store'])
        ->name('admin.matieres.store');

    Route::get('/matieres/{matiere}', [MatiereController::class, 'show'])
        ->name('admin.matieres.show');

    Route::get('/matieres/{matiere}/edit', [MatiereController::class, 'edit'])
        ->name('admin.matieres.edit');

    Route::put('/matieres/{matiere}', [MatiereController::class, 'update'])
        ->name('admin.matieres.update');

    Route::delete('/matieres/{matiere}', [MatiereController::class, 'destroy'])
        ->name('admin.matieres.destroy');

                //partie annee admin
Route::get('/annee', [AnneeScolaireController::class, 'index'])->name('admin.annee.index');
    Route::get('/annee/create', [AnneeScolaireController::class, 'create'])->name('admin.annee.create');
    Route::post('/annee', [AnneeScolaireController::class, 'store'])->name('admin.annee.store');
    Route::get('/annee/{annee}', [AnneeScolaireController::class, 'show'])->name('admin.annee.show');
    Route::get('/annee/{annee}/edit', [AnneeScolaireController::class, 'edit'])->name('admin.annee.edit');
    Route::put('/annee/{annee}', [AnneeScolaireController::class, 'update'])->name('admin.annee.update');
    Route::delete('/annee/{annee}', [AnneeScolaireController::class, 'destroy'])->name('admin.annee.destroy');
});

Route::get('/admin/ajout_classe', function(){
    return view('admin.ajout_classe');
})->name('ajout_classe.index');
Route::get('/admin/ajout_matiere', function(){
    return view('admin.ajout_matiere');
})->name('ajout_matiere.index');
Route::get('/admin/liste_classe', function(){
    return view('admin.liste_classe');
})->name('liste_classe.index');


//partie role admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('utilisateurs', UtilisateurController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function() {

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::put('/roles/{user}/update-role', [RoleController::class, 'updateRole'])->name('admin.roles.update');
    Route::delete('/roles/{user}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])
    ->name('admin.roles.create');
    Route::get('/roles/{user}', [RoleController::class, 'show'])->name('admin.roles.show'); // <-- ajouté
    Route::get('/roles/{user}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/admin/roles', [RoleController::class, 'store'])
    ->name('admin.roles.store');

});






Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    
});/*10*/

Route::get('enseignant/matieres-ajax/{classeId}', [EnseignantController::class, 'getMatieresClasse']);



Route::get('/test-role-auto', function () {

    $user = Utilisateur::create([
        'nom' => 'Test',
        'prenom' => 'Automatique',
        'email' => 'auto'.time().'@test.com',
        'password' => bcrypt('123456'),
        'role' => 'parent',
    ]);

    // 🔑 IMPORTANT : recharger la relation
    $user->load('roleRelation');

    return [
        'id' => $user->id,
        'role_enum' => $user->role,
        'id_role' => $user->id_role,
        'role_relation' => $user->roleRelation?->Nom,
    ];
});

Route::get('/parent/enseignant/{id}/profil', [ParentController::class, 'voirProfilEnseignant'])
     ->name('parent.enseignant.profil');

Route::middleware(['auth'])->prefix('enseignant')
->name('enseignant.')
->group(function () {
Route::get('devoir/cours/{cours}/create', [DevoirController::class, 'create'])->name('devoir.create');
    // Étape 1 : liste des cours pour choisir
    Route::get('devoir', [DevoirController::class, 'selectCours'])
        ->name('devoir.selectCours');

    // Étape 2 : devoirs d’un cours
    Route::get('devoir/cours/{cours}', [DevoirController::class, 'index'])
        ->name('devoir.index');

    // Étape 3 : ajout devoir
    Route::post('devoir/cours/{cours}', [DevoirController::class, 'store'])
        ->name('devoir.store');
    Route::get('devoir/{devoir}/show', [DevoirController::class, 'show'])->name('devoir.show');
    Route::get('devoir/{devoir}/edit', [DevoirController::class, 'edit'])->name('devoir.edit');
    Route::put('devoir/{devoir}', [DevoirController::class, 'update'])->name('devoir.update');
    Route::delete('devoir/{devoir}', [DevoirController::class, 'destroy'])->name('devoir.destroy');
});

//today


Route::get(
    '/parent/cours/{cours}/telecharger-contenu',
    [ParentController::class, 'telechargerContenu']
)->name('parent.cours.contenu');
Route::post('/parent/traiter_devoir', [EleveController::class, 'traiterDevoir'])
    ->name('parent.traiter_devoir')
    ->middleware('auth');
    

Route::middleware(['auth'])
    ->prefix('parent')
    ->name('parent.')
    ->group(function () {

    // 🔹 Formulaire inscription
    Route::get('/eleve/liste_inscription', [ParentController::class, 'inscriptionEleve'])
        ->name('eleve.inscription');

    // 🔹 Liste des élèves inscrits
    Route::get('/eleve/liste_inscription', [ParentController::class, 'listeInscriptions'])
        ->name('eleve.liste_inscription');
    // 🔹 Traitement inscription
    Route::post('/eleve/liste_inscription', [ParentController::class, 'store_Eleve'])
        ->name('eleve.store');
});
Route::get(
    '/parent/devoir/traiter-eleve',
    [EleveController::class, 'traiterDevoirEleve'])
    ->name('parent.traiter_devoir_eleve.get');

Route::post(
    '/parent/devoir/traiter-eleve',
    [EleveController::class, 'traiterDevoirEleve']
)->name('parent.traiter_devoir_eleve');
Route::post('/parent/devoir/reponse', [EleveController::class, 'envoyerReponseDevoir'])
    ->name('parent.reponse_devoir')
    ->middleware('auth');
Route::post('/enseignant/attribuer-note', [EnseignantController::class, 'attribuerNote'])->name('enseignant.attribuer_note');
Route::post('/enseignant/remarques', [EnseignantController::class, 'envoyerRemarque'])->name('enseignant.envoyer_remarque');






Route::get(
    'telecharger-reponse/fichier/{id}',
    [EnseignantController::class, 'telechargerFichier']
)->name('reponse.telecharger.fichier');

Route::get(
    'telecharger-reponse/contenu/{id}',
    [EnseignantController::class, 'telechargerContenu']
)->name('reponse.telecharger.contenu');


Route::get('/parent/notes', [ParentController::class, 'notes'])
    ->name('parent.notes')
    ->middleware('auth');
Route::middleware(['auth'])
    ->prefix('enseignant')
    ->name('enseignant.')
    ->group(function () {
        Route::resource('notes', \App\Http\Controllers\NoteController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
    });
Route::get('/parent/devoir/{id}/voir', [ParentController::class, 'voir'])->name('parent.voir_devoir');

Route::get('/parent/remarque', [ParentController::class, 'remarques'])
    ->name('parent.remarque')
    ->middleware('auth');
Route::middleware(['auth'])
    ->prefix('enseignant')
    ->name('enseignant.')
    ->group(function () {
        Route::resource('remarques', \App\Http\Controllers\NoteController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
    });
Route::get('/parent/devoir/{id}/voir', [ParentController::class, 'voir'])->name('parent.voir_devoir');
Route::middleware(['auth'])->prefix('enseignant')->name('enseignant.')->group(function () {
    Route::get('/liste-eleves', [EnseignantController::class, 'listeEleves'])
        ->name('liste_eleves');

});
Route::delete('/eleve/{id_eleve}/cours/{id_cours}', [EnseignantController::class, 'supprimerEleveCours'])
    ->name('eleve.supprimer_cours')
    ->middleware('auth');
Route::get('/parent/devoir/{devoir}/telecharger', [ParentController::class, 'telechargerDevoir'])
    ->name('parent.devoir.telecharger');
Route::middleware(['auth'])->group(function () {
    Route::get('/cours/{matiere}', [CoursController::class, 'show'])->name('cours.show');
});
Route::get('/coursgenerales/index_parent', [CoursgeneralesController::class, 'index_parent'])
    ->name('coursgenerales.index_parent');

Route::get('/parent/coursgenerales/{id}', [App\Http\Controllers\CoursgeneralesController::class, 'show_parent'])
    ->name('coursgenerales.show_parent');
Route::get('/parent/cours/{id}/download_contenu', [CoursgeneralesController::class, 'download_contenu'])
    ->name('cours.download_contenu');
Route::get('/parent/cours/{id}/download_fichier', [CoursgeneralesController::class, 'download_fichier'])
    ->name('cours.download_fichier');
Route::get('/coursgenerales/index_enseignant', [CoursgeneralesController::class, 'index_enseignant'])
    ->name('coursgenerales.index_enseignant');

Route::get('/enseignant/coursgenerales/{id}', [App\Http\Controllers\CoursgeneralesController::class, 'show_enseignant'])
    ->name('coursgenerales.show_enseignant');
Route::get('/enseignant/cours/{id}/download_contenus', [CoursgeneralesController::class, 'download_contenus'])
    ->name('cours.download_contenus');
Route::get('/enseignant/cours/{id}/download_fichiers', [CoursgeneralesController::class, 'download_fichiers'])
    ->name('cours.download_fichiers');

Route::get('/enseignant/parent/{eleve}', 
    [App\Http\Controllers\EnseignantController::class, 'voirParent']
)->name('enseignant.voir_parent');
Route::get('/parent/devoirs', [ParentController::class, 'devoirsParClasse'])
    ->name('parent.devoirs');