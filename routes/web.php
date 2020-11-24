<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
    /* FINCA API */
    Route::get('/fincas', 'FincaController@index');
    Route::post("/fincas/store","FincaController@store");
    Route::get("/fincas/{id}", "FincaController@show");
    Route::delete("/fincas/delete/{id}", "FincaController@destroy");
    Route::delete("/fincas/bulk-delete", "FincaController@destroy2");
   
    /* ANIMAL API */
    Route::get('/animal', 'AnimalController@index');
    Route::get('/animal/create', 'AnimalController@create');
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
    
    Route::post('/signup', 'UserController@signUp');
    Route::post('/signin', 'UserController@signIn');
    Route::post('/signinS', 'UserController@signInSocial');
    Route::get('/refreshToken', 'UserController@refreshToken');
