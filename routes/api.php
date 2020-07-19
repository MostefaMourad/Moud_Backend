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

Route::prefix('entreprise')->group(function () {
    Route::get('/', 'EntrepriseController@index');
    Route::post('/store', 'EntrepriseController@store');
    Route::get('/show/{id}', 'EntrepriseController@show');
    Route::patch('/update/{id}', 'EntrepriseController@update');
    Route::delete('/delete/{id}', 'EntrepriseController@destroy');
 });

 Route::prefix('utilisateur')->group(function () {
    Route::get('/', 'UtilisateurController@index');
    Route::get('/show/{id}', 'UtilisateurController@show');
    Route::delete('/delete/{id}', 'UtilisateurController@destroy');
 });

 Route::prefix('tache')->group(function () {
    Route::get('/', 'TacheController@index');
    Route::post('/store', 'TacheController@store');
    Route::get('/show/{id}', 'TacheController@show');
    Route::patch('/update/{id}', 'TacheController@update');
    Route::delete('/delete/{id}', 'TacheController@destroy');
 });