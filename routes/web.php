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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function(){
		if(Auth::check()){
			return view('home');
		}else {
			return view('auth.login');
		}
})->middleware('auth');

/* Rutas de Subjects */
Route::group(['middleware' => 'auth'], function() {

	Route::get('subjects', 'SubjectsController@getIndex');

	Route::get('subjects/show/{id}', 'SubjectsController@getShow');

	Route::get('subjects/create', 'SubjectsController@getCreate');
	Route::post('subjects/create', 'SubjectsController@postCreate');

	Route::get('subjects/edit/{id}', 'SubjectsController@getEdit');
	Route::put('subjects/edit/{id}', 'SubjectsController@putEdit');

	Route::delete('/subjects/delete/{id}', 'SubjectsController@deleteSubject');

});

/* Rutas de Teachers */
Route::group(['middleware' => 'auth'], function() {

	Route::get('teachers', 'TeachersController@getIndex');

	Route::get('teachers/show/{id}', 'TeachersController@getShow');

	Route::get('teachers/create', 'TeachersController@getCreate');
	Route::post('teachers/create', 'TeachersController@postCreate');

	Route::get('teachers/edit/{id}', 'TeachersController@getEdit');
	Route::put('teachers/edit/{id}', 'TeachersController@putEdit');

	Route::delete('/teachers/delete/{id}', 'TeachersController@deleteTeacher');

});

/* Rutas de Solicitudes */
Route::group(['middleware' => 'auth'], function() {

	Route::get('applications', 'ApplicationsController@getIndex');

	Route::get('applications/create', 'ApplicationsController@getCreate');



});