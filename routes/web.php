<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;

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
    return view('accueil');
})->name('accueil');
Route::get("categorie/search",[CategorieController::class,'search'])->name("categories.search");
Route::get("produit/search",[ProduitController::class,'search'])->name("produits.search");
Route::resource("categories",CategorieController::class);
Route::resource("produits",ProduitController::class);