<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */

// get('/user', function (Request $request) {
//     return $request->user();
// });

//
Route::post('register', [App\Http\Controllers\AuthController::class , 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class , 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [App\Http\Controllers\AuthController::class , 'user']);
    Route::post('logout', [App\Http\Controllers\AuthController::class , 'logout']);
    /////////////Routes Service Produits////////////////////////////////////////////////////////////////////////////////////
    Route::get('produit', [\App\Http\Controllers\ProduitController::class , 'index']);
    Route::get('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'show']);
    Route::post('produit', [\App\Http\Controllers\ProduitController::class , 'store']);
    Route::put('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'update']);
    Route::delete('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'destroy']);
    /////////////Routes Service Commandes///////////////////////////////////////////////////////////////////////////////////
    Route::get('commande', [\App\Http\Controllers\CommandeController::class , 'index']);
    Route::get('commande/{id}', [\App\Http\Controllers\CommandeController::class , 'show']);
    Route::post('commande', [\App\Http\Controllers\CommandeController::class , 'store']);
    Route::put('commande/{id}', [\App\Http\Controllers\CommandeController::class , 'update']);
    Route::delete('commande/{id}', [\App\Http\Controllers\CommandeController::class , 'destroy']);
    Route::post('commande/payer/{id}', [\App\Http\Controllers\CommandeController::class , 'SupprimerCommandeEtGererQuantiteProduit']);
    /////////////Routes Service Historiques///////////////////////////////////////////////////////////////////////////////////
    Route::get('historique', [\App\Http\Controllers\HistoriqueController::class , 'index']);
    Route::get('historique/{id}', [\App\Http\Controllers\HistoriqueController::class , 'show']);
});
