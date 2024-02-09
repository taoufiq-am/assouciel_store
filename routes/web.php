<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LigneCommandeController;
use App\Http\Controllers\RolePermissionController;
use Spatie\Permission\Middlewares\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("guest")->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/add/{id}', [HomeController::class, 'add'])->name('home.add');
    Route::get('/show', [HomeController::class, 'show'])->name('home.show');
    Route::get('/destroy/{id}', [HomeController::class, "destroy"])->name('home.destroy');
    Route::get('/clear', [HomeController::class, "clear"])->name('home.clear');
    Route::get('/search', [HomeController::class, "search"])->name('home.search');
    Route::get("/myOrders", [HomeController::class, "myOrders"])->name("home.myOrders");

    Route::resource("clients", ClientController::class);
    Route::resource("ligneCommandes", LigneCommandeController::class);
    Route::resource("commandes", CommandeController::class)->except('update','show');

});


Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/assign-permissions', [RolePermissionController::class, 'index'])->name('roles.show');
        Route::post('roles/{role}/assign-permissions', [RolePermissionController::class, 'assign'])->name('roles.assign-permissions');

        Route::resource('permissions', PermissionController::class);
        Route::get('/assign-role', [UserRoleController::class, 'index'])->name('user_roles.index');
        Route::get('{user}/assign-role', [UserRoleController::class, 'create'])->name('user_roles.create');
        Route::post('/{user}/assign-role', [UserRoleController::class, 'assignRoles'])->name('user_roles.store');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });
    Route::group(['middleware' => ['role:commercial']], function () {
        Route::get('/commandes', [CommandeController::class, "index"])->name('commandes.index');
        Route::get('/commandes/{id}', [CommandeController::class, "show"])->name('commandes.show');
        Route::get('/get-etats/{id}', [CommandeController::class, "getEtats"])->name('get-etats');
        Route::put('/commandes-update/{id}', [CommandeController::class, "update"]);
        Route::post('/commandes/exportCSV', [CommandeController::class, "exportCSV"])->name("commandes.exportCSV");
    });
    Route::group(['middleware' => ['role:magasinier']], function () {
        Route::resource("categories", CategorieController::class);
        Route::resource("produits", ProduitController::class);
        Route::get("categorie/search", [CategorieController::class, 'search'])->name("categories.search");
        Route::get("categorie/clear", [CategorieController::class, 'clear'])->name("categories.clear");

        Route::get("produit/search", [ProduitController::class, 'search'])->name("produits.search");
        Route::get("produit/clear", [ProduitController::class, 'clear'])->name("produits.clear");
    });

});

require __DIR__ . '/auth.php';
