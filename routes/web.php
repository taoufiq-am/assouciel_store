<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/add/{id}',[HomeController::class,'add'])->name('home.add');
Route::get('/show',[HomeController::class,'show'])->name('home.show');
Route::get('/destroy/{id}',[HomeController::class,"destroy"])->name('home.destroy'); 
Route::get('/clear}',[HomeController::class,"clear"])->name('home.clear'); 
Route::get('/clientInfo}',[HomeController::class,"clientInfo"])->name('home.clientInfo'); 
Route::post('/storeInfo}',[HomeController::class,"storeInfo"])->name('home.storeInfo'); 
Route::get("categorie/search",[CategorieController::class,'search'])->name("categories.search");
Route::get("produit/search",[ProduitController::class,'search'])->name("produits.search");
Route::resource("categories",CategorieController::class);
Route::resource("produits",ProduitController::class);