<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('historique/{user}', [\App\Http\Controllers\HistoriqueController::class , 'index']);
Route::get('historique/{user}/{id}', [\App\Http\Controllers\HistoriqueController::class , 'show']);
Route::post('historique/{user}', [\App\Http\Controllers\HistoriqueController::class , 'store']);