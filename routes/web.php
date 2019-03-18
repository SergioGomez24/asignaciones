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

	Route::get('json-subjects', 'SubjectsController@getSubjects');
	Route::get('json-subject', 'SubjectsController@getSubject');
	Route::get('json-certification', 'SubjectsController@getCertification');
	Route::get('json-area', 'SubjectsController@getArea');
	Route::get('json-campus', 'SubjectsController@getCampus');
	Route::get('json-center', 'SubjectsController@getCenter');
	Route::get('json-duration', 'SubjectsController@getDuration');
	Route::get('json-imparted', 'SubjectsController@getImparted');
	Route::get('json-typeSubject', 'SubjectsController@getTypeSubject');

	Route::get('subjects/create', 'SubjectsController@getCreate')->middleware('role');
	Route::post('subjects/create', 'SubjectsController@postCreate')->middleware('role');

	Route::get('subjects/edit/{id}', 'SubjectsController@getEdit')->middleware('role');
	Route::put('subjects/edit/{id}', 'SubjectsController@putEdit')->middleware('role');

	Route::delete('/subjects/delete/{id}', 'SubjectsController@deleteSubject')->middleware('role');

});

/* Rutas de Teachers */
Route::group(['middleware' => 'auth'], function() {

	Route::get('teachers', 'TeachersController@getIndex');

	Route::get('json-teacher', 'TeachersController@getTeacher');
	Route::get('json-category', 'TeachersController@getCategory');
	Route::get('json-user', 'TeachersController@getUser');

	Route::get('teachers/show/{id}', 'TeachersController@getShow');

	Route::get('teachers/create', 'TeachersController@getCreate')->middleware('role');
	Route::post('teachers/create', 'TeachersController@postCreate')->middleware('role');

	Route::get('teachers/edit/{id}', 'TeachersController@getEdit')->middleware('role');
	Route::put('teachers/edit/{id}', 'TeachersController@putEdit')->middleware('role');

	Route::delete('/teachers/delete/{id}', 'TeachersController@deleteTeacher')->middleware('role');

});

/* Rutas de Solicitudes */
Route::group(['middleware' => 'auth'], function() {

	Route::get('applications', 'ApplicationsController@getIndex');
	Route::get('applications/coordinator', 'ApplicationsController@getCoordinatorIndex');

	Route::get('applications/course/{course}', 'ApplicationsController@getCourseIndex');
	Route::get('applications/coordinator/course/{course}', 'ApplicationsController@getCoordinatorCourse');

	Route::get('index-filters', 'ApplicationsController@getCourseIndexFilters');

	Route::get('applications/create', 'ApplicationsController@getCreate');
	
	Route::get('json-application', 'ApplicationsController@getApplication');
	Route::post('applications/create', 'ApplicationsController@postCreate');

	Route::get('applications/edit/{id}', 'ApplicationsController@getEdit');
	Route::put('applications/edit/{id}', 'ApplicationsController@putEdit');

	Route::get('applications/coordinator/edit/{id}', 'ApplicationsController@getCoordinatorEdit');
	Route::put('applications/coordinator/edit/{id}', 'ApplicationsController@putCoordinatorEdit');

	Route::delete('/applications/delete/{id}', 'ApplicationsController@deleteApplication');

});

/* Ajustes */
Route::group(['middleware' => ['auth', 'role']], function() {

	Route::get('settings', function() {
	return view('settings.index');
	});

	/* Ajustes categoria */
	Route::get('settings/categories', 'CategoriesController@getIndex');

	Route::get('settings/categories/create', 'CategoriesController@getCreate');
	Route::post('settings/categories/create', 'CategoriesController@postCreate');

	Route::get('settings/categories/edit/{id}', 'CategoriesController@getEdit');
	Route::put('settings/categories/edit/{id}', 'CategoriesController@putEdit');

	Route::delete('/settings/categories/delete/{id}', 'CategoriesController@deleteCategory');

	/* Ajustes area */
	Route::get('settings/areas', 'AreasController@getIndex');

	Route::get('settings/areas/create', 'AreasController@getCreate');
	Route::post('settings/areas/create', 'AreasController@postCreate');

	Route::get('settings/areas/edit/{id}', 'AreasController@getEdit');
	Route::put('settings/areas/edit/{id}', 'AreasController@putEdit');

	Route::delete('/settings/areas/delete/{id}', 'AreasController@deleteArea');

	/* Ajustes titulacion */
	Route::get('settings/certifications', 'CertificationsController@getIndex');

	Route::get('settings/certifications/create', 'CertificationsController@getCreate');
	Route::post('settings/certifications/create', 'CertificationsController@postCreate');

	Route::get('settings/certifications/edit/{id}', 'CertificationsController@getEdit');
	Route::put('settings/certifications/edit/{id}', 'CertificationsController@putEdit');

	Route::delete('/settings/certifications/delete/{id}', 'CertificationsController@deleteCertification');

	/* Ajustes campus */
	Route::get('settings/campus', 'CampusController@getIndex');

	Route::get('settings/campus/create', 'CampusController@getCreate');
	Route::post('settings/campus/create', 'CampusController@postCreate');

	Route::get('settings/campus/edit/{id}', 'CampusController@getEdit');
	Route::put('settings/campus/edit/{id}', 'CampusController@putEdit');

	Route::delete('/settings/campus/delete/{id}', 'CampusController@deleteCampus');

	/* Ajustes centros */
	Route::get('settings/centers', 'CentersController@getIndex');

	Route::get('settings/centers/create', 'CentersController@getCreate');
	Route::post('settings/centers/create', 'CentersController@postCreate');

	Route::get('settings/centers/edit/{id}', 'CentersController@getEdit');
	Route::put('settings/centers/edit/{id}', 'CentersController@putEdit');

	Route::delete('/settings/centers/delete/{id}', 'CentersController@deleteCenter');

});

