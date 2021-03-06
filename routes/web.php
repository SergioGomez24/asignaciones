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

Route::get('home', 'HomeController@getIndex')->middleware('auth');

Route::get('/', function(){
		if(Auth::check()){
			return redirect('home');
		}else {
			return view('auth.login');
		}
})->middleware('auth');

/* Rutas de Subjects */
Route::group(['middleware' => 'auth'], function() {

	Route::get('subjects', 'SubjectsController@getIndex');

	Route::get('json-subjects', 'SubjectsController@getSubjects');
	Route::get('json-subject', 'SubjectsController@getSubject');
	Route::get('json-subjectCode', 'SubjectsController@getSubjectCode');
	Route::get('json-subjectName', 'SubjectsController@getSubjectName');

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
	Route::get('json-teacherName', 'TeachersController@getTeacherName');
	Route::get('json-teacherDni', 'TeachersController@getTeacherDni');
	Route::get('json-user', 'TeachersController@getUser');
	Route::get('json-userEmail', 'TeachersController@getUserEmail');
	Route::get('json-userName', 'TeachersController@getUserName');

	Route::get('teachers/show/{id}', 'TeachersController@getShow');

	Route::get('teachers/create', 'TeachersController@getCreate')->middleware('role');
	Route::post('teachers/create', 'TeachersController@postCreate')->middleware('role');

	Route::get('teachers/edit/{id}', 'TeachersController@getEdit')->middleware('role');
	Route::put('teachers/edit/{id}', 'TeachersController@putEdit')->middleware('role');

	Route::get('teachers/perfil/{id}', 'TeachersController@getEditPerfil');
	Route::put('teachers/perfil/{id}', 'TeachersController@putEditPerfil');

	Route::delete('/teachers/delete/{id}', 'TeachersController@deleteTeacher')->middleware('role');

});

/* Rutas de elecciones */
Route::group(['middleware' => 'auth'], function() {

	Route::get('elections', 'ElectionsController@getCourse');
	Route::get('elections/index/{course}', 'ElectionsController@getIndex');

	Route::get('json-election', 'ElectionsController@getElection');
	Route::get('json-electionProf', 'ElectionsController@getElectionProf');

	Route::get('elections/pdf/{course}', 'ElectionsController@elections');
});



/* Rutas de Solicitudes */
Route::group(['middleware' => 'auth'], function() {

	/* Rutas de Solicitudes de Profesores */

	Route::get('solicitudes/teacher', 'SolicitudesController@getCourseTeacher');
	Route::get('solicitudes/teacher/index/{course}', 'SolicitudesController@getTeacherIndex');

	Route::get('solicitudes/teacher/edit/{id}', 'SolicitudesController@getTeacherEdit');
	Route::put('solicitudes/teacher/edit/{id}', 'SolicitudesController@putTeacherEdit');

	/* */
	/* Rutas de Solicitudes de Director */
	Route::get('solicitudes/director', 'SolicitudesController@getCourseDirector');
	Route::get('solicitudes/director/menu/{course}', 'SolicitudesController@getMenu');
	Route::get('solicitudes/director/state/{course}', 'SolicitudesController@getState');
	Route::get('solicitudes/director/teacher/{course}', 'SolicitudesController@getTeacherList');
	Route::get('solicitudes/director/index/{course}/{teacher_id}', 'SolicitudesController@getDirectorIndex');

	Route::get('solicitudes/director/create/{course}/{teacher_id}', 'SolicitudesController@getDirectorCreate');
	Route::post('solicitudes/director/create/{course}/{teacher_id}', 'SolicitudesController@postDirectorCreate');

	Route::get('solicitudes/director/edit/{id}', 'SolicitudesController@getDirectorEdit');
	Route::put('solicitudes/director/edit/{id}', 'SolicitudesController@putDirectorEdit');

	/* */

	Route::get('index-filters', 'SolicitudesController@getCourseIndexFilters');
	Route::get('json-solicitude', 'SolicitudesController@getSolicitude');

	Route::get('json-solicitudes', 'SolicitudesController@getSolicitudes');
	Route::get('json-solicitudesSubject', 'SolicitudesController@getSolicitudesSubject');

	Route::get('json-category', 'CategoriesController@getCategory');
	Route::get('json-area', 'AreasController@getArea');
	Route::get('json-certification', 'CertificationsController@getCertification');
	Route::get('json-campus', 'CampusController@getCampus');
	Route::get('json-course', 'CoursesController@getCourse');
	Route::get('json-center', 'CentersController@getCenter');
	Route::get('json-duration', 'DurationsController@getDuration');
	Route::get('json-imparted', 'CoursesSubjectsController@getImparted');
	Route::get('json-typeSubject', 'TypesSubjectsController@getTypeSubject');

	Route::get('solicitudes/course', 'SolicitudesController@getCourse');
	Route::get('solicitudes/create/{course}', 'SolicitudesController@getCreate');
	Route::post('solicitudes/create/{course}', 'SolicitudesController@postCreate');

	Route::delete('/solicitudes/delete/{id}', 'SolicitudesController@deleteSolicitude');

	Route::post('/solicitudes/edit/profPermission/{course}', 'SolicitudesController@editPermissionProf');
	Route::post('/solicitudes/edit/coorPermission/{course}', 'SolicitudesController@editPermissionCoor');
	Route::post('/solicitudes/edit/dirPermission/{course}', 'SolicitudesController@editPermissionDir');
	Route::post('/solicitudes/openElection/{course}', 'SolicitudesController@openElection');

});

/* Rutas de Coordinadores */
Route::group(['middleware' => 'auth'], function() {

	Route::get('coordinators', 'CoordinatorsController@getCourse');
	Route::get('coordinators/subjects/{course}', 'CoordinatorsController@getSubjectsCoor');
	Route::get('coordinators/index/{course}', 'CoordinatorsController@getIndex');

	Route::get('json-coordinator', 'CoordinatorsController@getCoordinator');

	Route::get('coordinators/edit/{id}', 'CoordinatorsController@getEdit');
	Route::put('coordinators/edit/{id}', 'CoordinatorsController@putEdit');

	Route::delete('/coordinators/delete/{id}', 'CoordinatorsController@deleteSolicitudeCoor');
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

	/* Ajustes cursos */
	Route::get('settings/courses', 'CoursesController@getIndex');

	Route::get('settings/courses/create', 'CoursesController@getCreate');
	Route::post('settings/courses/create', 'CoursesController@postCreate');

	Route::get('settings/courses/edit/{id}', 'CoursesController@getEdit');
	Route::put('settings/courses/edit/{id}', 'CoursesController@putEdit');

	Route::delete('/settings/courses/delete/{id}', 'CoursesController@deleteCourse');

	/* Ajustes centros */
	Route::get('settings/centers', 'CentersController@getIndex');

	Route::get('settings/centers/create', 'CentersController@getCreate');
	Route::post('settings/centers/create', 'CentersController@postCreate');

	Route::get('settings/centers/edit/{id}', 'CentersController@getEdit');
	Route::put('settings/centers/edit/{id}', 'CentersController@putEdit');

	Route::delete('/settings/centers/delete/{id}', 'CentersController@deleteCenter');

	/*Ajustes duraciones*/
	Route::get('settings/duration', 'DurationsController@getIndex');

	Route::get('settings/duration/create', 'DurationsController@getCreate');
	Route::post('settings/duration/create', 'DurationsController@postCreate');

	Route::get('settings/duration/edit/{id}', 'DurationsController@getEdit');
	Route::put('settings/duration/edit/{id}', 'DurationsController@putEdit');

	Route::delete('/settings/duration/delete/{id}', 'DurationsController@deleteDuration');

	/*Ajustes cursos asignaturas*/
	Route::get('settings/coursesSubjects', 'CoursesSubjectsController@getIndex');

	Route::get('settings/coursesSubjects/create', 'CoursesSubjectsController@getCreate');
	Route::post('settings/coursesSubjects/create', 'CoursesSubjectsController@postCreate');

	Route::get('settings/coursesSubjects/edit/{id}', 'CoursesSubjectsController@getEdit');
	Route::put('settings/coursesSubjects/edit/{id}', 'CoursesSubjectsController@putEdit');

	Route::delete('/settings/CoursesSubjects/delete/{id}', 'CoursesSubjectsController@deleteCourseSubject');

	/*Ajustes tipos asignaturas*/
	Route::get('settings/typesSubjects', 'TypesSubjectsController@getIndex');

	Route::get('settings/typesSubjects/create', 'TypesSubjectsController@getCreate');
	Route::post('settings/typesSubjects/create', 'TypesSubjectsController@postCreate');

	Route::get('settings/typesSubjects/edit/{id}', 'TypesSubjectsController@getEdit');
	Route::put('settings/typesSubjects/edit/{id}', 'TypesSubjectsController@putEdit');

	Route::delete('/settings/TypesSubjects/delete/{id}', 'TypesSubjectsController@deleteTypeSubject');

	/*Ajustes elecciones*/
	Route::get('settings/elections', 'ElectionsController@getIndexSettings');

	Route::get('settings/elections/create', 'ElectionsController@getCreate');
	Route::post('settings/elections/create', 'ElectionsController@postCreate');

	Route::get('settings/elections/edit/{course}', 'ElectionsController@getEdit');
	Route::put('settings/elections/edit/{course}', 'ElectionsController@putEdit');

	Route::delete('/settings/elections/delete/{course}', 'ElectionsController@deleteElection');

});

