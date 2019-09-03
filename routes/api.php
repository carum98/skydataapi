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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('cliente','Cliente\ClienteControler');

Route::resource('radio', 'Radio\RadioControler');

Route::resource('users', 'User\UserControler');

Route::get('cliente/{cliente}/radios', 'RadioCliente\RadioClienteControler@cliente');
Route::get('users/verify/{token}', 'User\UserControler@verify')->name('verify');
Route::get('users/{user}/resent', 'User\UserControler@resent')->name('resent');