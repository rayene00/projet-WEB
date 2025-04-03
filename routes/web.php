<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Pages publiques
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\FirstPageController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/firstpage', [FirstPageController::class, 'index'])->name('firstpage');

use App\Http\Controllers\QuisommesnousController;
Route::get('/quisommesnous', [QuisommesnousController::class, 'index'])->name('quisommesnous');

use App\Http\Controllers\MentionsController;
Route::get('/mentions', [MentionsController::class, 'index'])->name('mentions');

use App\Http\Controllers\CguController;
Route::get('/cgu', [CguController::class, 'index'])->name('cgu');

use App\Http\Controllers\ContactController;
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'envoyer'])->name('contact.envoyer');

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\SigninController;
Route::get('/signin', [SigninController::class, 'show'])->name('signin');
Route::post('/signin', [SigninController::class, 'login'])->name('signin.login');

use App\Http\Controllers\SignupController;
Route::get('/signup', [SignupController::class, 'show'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup.register');

use App\Http\Controllers\ForgetPasswordController;
Route::get('/forgetpassword', [ForgetPasswordController::class, 'show'])->name('forgetpassword');
Route::post('/forgetpassword', [ForgetPasswordController::class, 'handle']);

use App\Http\Controllers\ResetPasswordController;
Route::get('/reset-password', [ResetPasswordController::class, 'show'])->name('resetpassword');
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::post('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect()->route('firstpage');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Utilisateur connecté
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ApresConnexionController;
Route::get('/apresconnexion', [ApresConnexionController::class, 'index'])->middleware('auth')->name('apresconnexion');

// ✅ Route corrigée ici : "profile.etudiant" (et pas "profil.etudiant")
Route::get('/profiletudiant', function () {
    return view('profiletudiant');
})->middleware('auth')->name('profile.etudiant');

Route::get('/profilpilote', function () {
    return view('profilpilote');
})->middleware('auth')->name('profile.pilote');

/*
|--------------------------------------------------------------------------
| Fonctionnalités principales
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\OffresController;
Route::get('/offres', [OffresController::class, 'index'])->name('offres');

use App\Http\Controllers\AvisController;
Route::get('/avis', [AvisController::class, 'index'])->name('avis');
Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');

use App\Http\Controllers\RechercheController;
Route::get('/recherche', [RechercheController::class, 'index'])->name('recherche');

use App\Http\Controllers\ZoomEntrepriseController;
Route::get('/entreprise/{id}', [ZoomEntrepriseController::class, 'show'])->name('zoomentreprise');

use App\Http\Controllers\ZoomOffreController;
Route::get('/offre/{id}', [ZoomOffreController::class, 'show'])->name('zoomo');

use App\Http\Controllers\PostulerController;
Route::middleware('auth')->group(function () {
    Route::get('/postuler/{offre_id}', [PostulerController::class, 'show'])->name('postuler.show');
    Route::post('/postuler/{offre_id}', [PostulerController::class, 'submit'])->name('postuler.submit');
});

use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Redirection si auth échoue
|--------------------------------------------------------------------------
*/

// Redirige automatiquement /login vers la page de connexion personnalisée
Route::get('/login', function () {
    return redirect()->route('signin');
});

use App\Http\Controllers\ProfileController;

Route::post('/profiletudiant/photo', [ProfileController::class, 'uploadPhoto'])
    ->middleware('auth')
    ->name('profile.photo.upload');

Route::post('/profile/update', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::post('/profile/delete', [ProfileController::class, 'delete'])
    ->middleware('auth')
    ->name('profile.delete');

