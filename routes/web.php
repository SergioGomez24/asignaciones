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
	Route::post('applications/create', 'ApplicationsController@postCreate');



});

/* Ajustes */
Route::group(['middleware' => 'auth'], function() {

	Route::get('settings', function() {
	return view('settings.index');
	});

	/* Ajustes categoria */
	Route::get('settings/categories', 'CategoriesController@getIndex');

	Route::get('settings/categories/create', 'CategoriesController@getCreate');
	Route::post('settings/categories/create', 'CategoriesController@postCreate');

	Route::get('settings/categories/show/{id}', 'CategoriesController@getShow');

	Route::get('settings/categories/edit/{id}', 'CategoriesController@getEdit');
	Route::put('settings/categories/edit/{id}', 'CategoriesController@putEdit');

	Route::delete('/settings/categories/delete/{id}', 'CategoriesController@deleteCategory');

	/* Ajustes area */
	Route::get('settings/areas', 'AreasController@getIndex');

	Route::get('settings/areas/create', 'AreasController@getCreate');
	Route::post('settings/areas/create', 'AreasController@postCreate');

	Route::get('settings/areas/show/{id}', 'AreasController@getShow');

	Route::get('settings/areas/edit/{id}', 'AreasController@getEdit');
	Route::put('settings/areas/edit/{id}', 'AreasController@putEdit');

	Route::delete('/settings/areas/delete/{id}', 'AreasController@deleteArea');



});

