<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/add/{id}',[HomeController::class,'add'])->name('home.add');
Route::get('/show',[HomeController::class,'show'])->name('home.show');
Route::get('/destroy/{id}',[HomeController::class,"destroy"])->name('home.destroy'); 
Route::get('/clear',[HomeController::class,"clear"])->name('home.clear'); 
Route::get('/search',[HomeController::class,"search"])->name('home.search'); 


Route::get("categorie/search",[CategorieController::class,'search'])->name("categories.search");
Route::get("categorie/clear",[CategorieController::class,'clear'])->name("categories.clear");

Route::get("produit/search",[ProduitController::class,'search'])->name("produits.search");
Route::get("produit/clear",[ProduitController::class,'clear'])->name("produits.clear");


Route::get("/myOrders",[HomeController::class,"myOrders"])->name("home.myOrders");
Route::post('/commandes/exportCSV',[CommandeController::class,"exportCSV"])->name("commandes.exportCSV");


Route::resource("categories",CategorieController::class);
Route::resource("produits",ProduitController::class);
Route::resource("clients",ClientController::class);
Route::resource("commandes",CommandeController::class);
Route::resource("ligneCommandes",LigneCommandeController::class);
