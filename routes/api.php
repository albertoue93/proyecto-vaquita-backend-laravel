<?php

use Illuminate\Http\Request;

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
Route::group(['middleware' => 'jwt.auth'], function() {
    /* FINCA API */
    Route::get('/fincas', 'FincaController@index');
    Route::post("/fincas/store","FincaController@store");
    Route::get("/fincas/{id}", "FincaController@show");
    Route::delete("/fincas/delete/{id}", "FincaController@destroy");
    Route::delete("/fincas/bulk-delete", "FincaController@destroy2");

    /* ANIMAL API */
    Route::get('/animal', 'AnimalController@index');
    Route::post("/animal/store","AnimalController@store");
    Route::get("/animal/{id}", "AnimalController@show");
    Route::delete("/animal/delete/{id}", "AnimalController@destroy");
    Route::delete("/animal/bulk-delete", "AnimalController@destroy2");
    Route::put("/animal/updateStatus", "AnimalController@updateStatus");

    /* APARTO API */
    Route::get('/aparto', 'ApartoController@index');
    Route::post("/aparto/store","ApartoController@store");
    Route::get("/aparto/{id}", "ApartoController@show");
    Route::delete("/aparto/delete/{id}", "ApartoController@destroy");
    Route::delete("/aparto/bulk-delete", "ApartoController@destroy2");
});

Route::post('/signup', 'UserController@signUp');
Route::post('/signin', 'UserController@signIn');
Route::get('/refreshToken', 'FrontEndUserController@refreshToken');