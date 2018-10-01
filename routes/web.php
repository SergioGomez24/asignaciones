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
Route::GET('/logout', 'Auth\LoginController@logout');
Auth::routes();

/* Rutas de Subjects */
Route::group(['middleware' => 'auth'], function() {

	Route::GET('/', function(){
		if(Auth::check()){
			return view('home');
		}else {
			return Redirect::action('HomeController@getLogin');
		}
	});

	Route::get('subjects', 'SubjectsController@getIndex');

	Route::get('subjects/show/{id}', 'SubjectsController@getShow');

	Route::get('subjects/create', 'SubjectsController@getCreate');
	Route::POST('subjects/create', 'SubjectsController@postCreate');

	Route::get('subjects/edit/{id}', 'SubjectsController@getEdit');
	Route::PUT('subjects/edit/{id}', 'SubjectsController@putEdit');

	Route::DELETE('/subjects/delete/{id}', 'SubjectsController@deleteSubject');

});

/* Rutas de Teachers */
Route::group(['middleware' => 'auth'], function() {

	Route::get('teachers', 'TeachersController@getIndex');

	Route::get('teachers/show/{id}', 'TeachersController@getShow');

	Route::get('teachers/create', 'TeachersController@getCreate');
	Route::POST('teachers/create', 'TeachersController@postCreate');

	Route::get('teachers/edit/{id}', 'TeachersController@getEdit');
	Route::PUT('teachers/edit/{id}', 'TeachersController@putEdit');

	Route::DELETE('/teachers/delete/{id}', 'TeachersController@deleteTeacher');

});