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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('member','MemberController@index');
Route::get('/member/{id_user}','MemberController@getId');
Route::post('/member','MemberController@create');
Route::put('/member/update/{id_user}','MemberController@update');
Route::delete('/member/{id_user}','MemberController@delete');

Route::get('admin','AdminController@index');
Route::get('/admin/{id}','AdminController@getId');
Route::post('/admin','AdminController@create');
Route::put('/admin/update/{id}','AdminController@update');
Route::delete('/admin/{id}','AdminController@delete');

Route::get('film','FilmController@index');
Route::get('/film/{id_film}','FilmController@getId');
Route::post('/film','FilmController@create');
Route::put('/film/update/{id_film}','FilmController@update');
Route::delete('/film/{id_film}','FilmController@delete');

Route::get('theater','TheaterController@index');
Route::get('/theater/{id}','TheaterController@getId');
Route::post('/theater','TheaterController@create');
Route::put('/theater/update/{id}','TheaterController@update');
Route::delete('/theater/{id}','TheaterController@delete');