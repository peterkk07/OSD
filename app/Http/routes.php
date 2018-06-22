<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/form', function (){
    return view("form");
});

Route::get('/', 'HomeController@index');
Route::get('/test','testController@index');
Route::post('/test-select','testController@selected');




Route::auth();
 
/* ADMIN */
Route::get('/crear-primer-admin', 'DashboardController@createFirstAdminForm');

Route::post('/almacenarAdmin', 'DashboardController@createAdmin');

Route::post('/dashboard/addUser', 'DashboardController@addUser');


Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/mostrar-usuarios', 'DashboardController@showUsers');
Route::post('/dashboard/mostrar-rol', 'DashboardController@showRol');
Route::get('/dashboard/mostrar-rol', 'DashboardController@showUsers');

Route::get('/dashboard/editarUsuario/{id}', 'DashboardController@editUserForm');
Route::post('/dashboard/editar-usuario', 'DashboardController@editUser');

Route::get('/dashboard/eliminar-usuario/{id}', 'DashboardController@deleteUserMessage');
Route::post('/dashboard/confirmar-eliminacion', 'DashboardController@deleteConfirm');

Route::post('/dashboard/remover-usuario/{id}', 'DashboardController@removeUser');

Route::get('/dashboard/crear-usuario', 'DashboardController@showCreateUserForm');


/*Encuesta*/

Route::get('/dashboard/crear-encuesta', 'DashboardController@showCreateSurveyForm');
Route::post('/dashboard/almacenar-cuenta', 'DashboardController@createSurvey');

Route::get('/dashboard/mostrar-encuestas', 'DashboardController@showSurvey');

Route::get('/dashboard/seleccionar-encuesta/{id}', 'DashboardController@selectSurvey');

Route::get('/dashboard/editar-encuesta-form', 'DashboardController@editSurveyForm');

Route::post('/dashboard/editar-encuesta', 'DashboardController@editSurvey');


Route::get('/dashboard/mostrar-preguntas/{id}', 'DashboardController@showQuestionsForm');

Route::get('/dashboard/editar-preguntas/{id}', 'DashboardController@editQuestionsForm');

Route::post('/dashboard/editar-preguntas', 'DashboardController@editQuestions');

Route::get('/dashboard/eliminar-encuesta/{id}', 'DashboardController@deleteSurvey');

/*Áreas de conocimiento */

Route::get('/dashboard/areas', 'DashboardController@createKnowledgeAreaForm');


Route::get('/dashboard/elegir-area', function (){
    return redirect()->to('/dashboard/areas');
});

Route::post('/dashboard/agregar-areas', 
	'DashboardController@createKnowledgeAreas');



Route::get('/dashboard/ver-areas', 'DashboardController@viewKnowledgeAreas');

Route::get('/dashboard/ver-materia/{id}', 'DashboardController@viewSubject');

Route::get('/dashboard/editar-materias/{id}', 'DashboardController@editSubjectForm');

Route::post('/dashboard/agregar-materias', 'DashboardController@editSubject');

Route::get('/dashboard/eliminar-materia/{id}', 'DashboardController@deleteSubject');


Route::get('/dashboard/eliminar-area/{id}', 'DashboardController@deleteArea');



