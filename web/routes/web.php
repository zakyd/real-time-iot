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
    return redirect('/view-values');
})->middleware('logged');
Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', 'UserController@logout')->middleware('logged');
Route::get('/view-users', 'UserController@view')->middleware('logged');
Route::get('/create-user', 'UserController@create')->middleware('logged');
Route::get('/delete-user', 'UserController@delete')->middleware('logged');
Route::get('/edit-user', 'UserController@edit')->middleware('logged');
Route::post('/save-user', 'UserController@save')->middleware('logged');
Route::post('/update-user', 'UserController@update')->middleware('logged');
Route::post('/authentication', 'UserController@auth');

Route::get('/add-value', 'ValueController@add');
Route::get('/view-values', 'ValueController@view')->middleware('logged');
Route::get('/request-data', 'ValueController@request')->middleware('logged');