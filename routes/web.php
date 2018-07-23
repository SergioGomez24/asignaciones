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

Route::get('/', 'HomeController@getHome');

Route::get('login', function () {
    return view('auth.login');
});

Route::get('logout', function () {
    return 'Logout usuario';
});

Route::get('subjects', 'SubjectsController@getIndex');

Route::get('subjects/show/{id}', 'SubjectsController@getShow');

Route::get('subjects/create', 'SubjectsController@getCreate');

Route::get('subjects/edit/{id}', 'SubjectsController@getEdit');
