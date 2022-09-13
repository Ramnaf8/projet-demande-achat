<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */

Route::get('produit', [\App\Http\Controllers\ProduitController::class , 'index']);
Route::get('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'show']);
Route::post('produit', [\App\Http\Controllers\ProduitController::class , 'store']);
Route::put('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'update']);
Route::delete('produit/{id}', [\App\Http\Controllers\ProduitController::class , 'destroy']);
