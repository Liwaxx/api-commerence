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
//User
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/deleteUser/{id}', 'UserController@deleteUser');

//Barang
Route::post('/addBarang', 'BarangController@add');
Route::post('/updateBarang/{id}', 'BarangController@update');
Route::get('/deleteBarang/{id}', 'BarangController@delete');
Route::get('/getAllBarang', 'BarangController@getAll');
