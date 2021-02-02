<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Passport\Client;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\Token;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Não atenticadas
 */
Route::group(['middleware' => 'guest:api'], function () {

    Route::post('/login','Api\AuthController@login');
});

/**
 * Autenticadas
 */
Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/autenticada',function(Request $request){
        dd("Voce acessou a rota autenticada");
    });

    Route::post('/logout','Api\AuthController@logout');
});
