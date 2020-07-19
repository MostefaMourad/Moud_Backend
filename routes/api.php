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
