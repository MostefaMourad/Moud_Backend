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

/******************************Utilisateur Moud APIs  ***************************/

Route::post('utilisateur/login', 'API\UtilisateurLoginController@login');
Route::post('utilisateur/register', 'API\UtilisateurRegisterController@register');

Route::group(['middleware' => 'auth:utilisateur-api'], function(){
   Route::get('utilisateur/profil', 'API\UtilisateurController@profil');
   Route::post('utilisateur/profil/update', 'API\UtilisateurController@update');
   Route::get('utilisateur/taches', 'API\UtilisateurController@taches');
   Route::get('utilisateur/tache/show/{id}', 'API\UtilisateurController@show');
   Route::post('utilisateur/tache/reponse', 'API\UtilisateurController@store');
   Route::get('utilisateur/verifications', 'API\UtilisateurController@verifications');
   Route::get('utilisateur/verification/show/{id}', 'API\UtilisateurController@showReponse');
   Route::post('utilisateur/verification/store', 'API\UtilisateurController@storeValid');
});

/****************************** Entreprise-Moud APIs  ***************************/

Route::post('entreprise/login', 'API\EntrepriseLoginController@login');




Route::group(['middleware' => 'auth:utilisateur-api'], function(){
   Route::post('utilisateur/details', 'API\UtilisateurController@details');
});

Route::group(['middleware' => 'auth:entreprise-api'], function(){
   Route::post('entreprise/details', 'API\EntrepriseController@details');
   Route::get('entreprise/taches', 'API\EntrepriseController@taches');
   Route::get('entreprise/tache/{id}', 'API\EntrepriseController@tache');
});



/****************************** Admin-Moud APIs  ***************************/






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

Route::prefix('reponsetache')->group(function () {
   Route::get('/', 'ReponseTacheController@index');
   Route::post('/store', 'ReponseTacheController@store');
   Route::get('/show/{id}', 'ReponseTacheController@show');
   Route::patch('/update/{id}', 'ReponseTacheController@update');
   Route::delete('/delete/{id}', 'ReponseTacheController@destroy');
});

Route::prefix('question')->group(function () {
   Route::get('/', 'QuestionController@index');
   Route::post('/store', 'QuestionController@store');
   Route::get('/show/{id}', 'QuestionController@show');
   Route::patch('/update/{id}', 'QuestionController@update');
   Route::delete('/delete/{id}', 'QuestionController@destroy');
});

Route::prefix('reponseon')->group(function () {
   Route::get('/', 'ReponseONController@index');
   Route::post('/store', 'ReponseONController@store');
   Route::get('/show/{id}', 'ReponseONController@show');
   Route::patch('/update/{id}', 'ReponseONController@update');
   Route::delete('/delete/{id}', 'ReponseONController@destroy');
});

Route::prefix('reponsewh')->group(function () {
   Route::get('/','ReponseWHController@index');
   Route::post('/store','ReponseWHController@store');
   Route::get('/show/{id}','ReponseWHController@show');
   Route::patch('/update/{id}','ReponseWHController@update');
   Route::delete('/delete/{id}','ReponseWHController@destroy');
});

Route::prefix('transaction')->group(function () {
   Route::get('/','TransactionController@index');
   Route::post('/store','TransactionController@store');
   Route::get('/show/{id}','TransactionController@show');
   Route::patch('/update/{id}','TransactionController@update');
   Route::delete('/delete/{id}','TransactionController@destroy');
});

Route::prefix('verification')->group(function () {
   Route::get('/','VerificationController@index');
   Route::post('/store','VerificationController@store');
   Route::get('/show/{id}','VerificationController@show');
   Route::patch('/update/{id}','VerificationController@update');
   Route::delete('/delete/{id}','VerificationController@destroy');
});