<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */

Route::get('commande/{user}', [\App\Http\Controllers\CommandeController::class , 'index']);
Route::get('commande/{user}/{id}', [\App\Http\Controllers\CommandeController::class , 'show']);
Route::post('commande/{user}', [\App\Http\Controllers\CommandeController::class , 'store']);
Route::put('commande/{user}/{id}', [\App\Http\Controllers\CommandeController::class , 'update']);
Route::delete('commande/{user}/{id}', [\App\Http\Controllers\CommandeController::class , 'destroy']);
Route::post('commande/payer/{user}/{id}', [\App\Http\Controllers\CommandeController::class , 'SupprimerCommandeEtGererQuantiteProduit']);
