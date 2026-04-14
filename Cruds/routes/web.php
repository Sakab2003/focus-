<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/delete-etudiant/{id}', [EtudiantController::class, 'delete_etudiant']);
Route::get('/update-etudiant/{id}', [EtudiantController::class, 'update_etudiant']);
Route::POST('/update/traitement', [EtudiantController::class, 'update_etudiant_traitement']);
Route::get('/etudiant', [EtudiantController::class, 'liste_etudiant']);
Route::get('/ajouter', [EtudiantController::class, 'ajouter_etudiant']);
Route::POST('/ajouter/traitement', [EtudiantController::class, 'ajouter_etudiant_traitement']);