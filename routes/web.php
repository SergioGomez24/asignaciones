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

Route::get('/', 'HomeController@index');
Auth::routes();

Route::group(['middleware' => 'auth'], function() {

	Route::get('subjects', 'SubjectsController@getIndex');

	Route::get('subjects/show/{id}', 'SubjectsController@getShow');

	Route::get('subjects/create', 'SubjectsController@getCreate');
	Route::POST('subjects/create', 'SubjectsController@postCreate');

	Route::get('subjects/edit/{id}', 'SubjectsController@getEdit');
	Route::PUT('subjects/edit/{id}', 'SubjectsController@putEdit');

	Route::DELETE('/subjects/delete/{id}', 'SubjectsController@deleteSubject');

	//Route::get('/', 'HomeController@index');
});


