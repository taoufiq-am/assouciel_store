<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\LigneCommandeController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/add/{id}', [HomeController::class, 'add'])->name('home.add');
    Route::get('/show', [HomeController::class, 'show'])->name('home.show');
    Route::get('/destroy/{id}', [HomeController::class, "destroy"])->name('home.destroy');
    Route::get('/clear', [HomeController::class, "clear"])->name('home.clear');
    Route::get('/search', [HomeController::class, "search"])->name('home.search');
    Route::get("/myOrders", [HomeController::class, "myOrders"])->name("home.myOrders");
    Route::resource("clients", ClientController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get("categorie/search", [CategorieController::class, 'search'])->name("categories.search");
    Route::get("categorie/clear", [CategorieController::class, 'clear'])->name("categories.clear");

    Route::get("produit/search", [ProduitController::class, 'search'])->name("produits.search");
    Route::get("produit/clear", [ProduitController::class, 'clear'])->name("produits.clear");
    Route::post('/commandes/exportCSV', [CommandeController::class, "exportCSV"])->name("commandes.exportCSV");

    Route::resource("categories", CategorieController::class);
    Route::resource("produits", ProduitController::class);
    Route::resource("commandes", CommandeController::class);
    Route::resource("ligneCommandes", LigneCommandeController::class);
});
