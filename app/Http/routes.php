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

/*test*/

/*Route::get('cargar-datos',array('as'=>'excel.import','uses'=>'FileController@importExportExcelORCSV'));*/
Route::get('cargar-datos', 'FileController@importExportExcelORCSV');


Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'FileController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'FileController@downloadExcelFile'));



Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('/test','testController@index');
Route::post('/test-select','testController@selected');


Route::get('/profesores', 'testController@showTeacher');

Route::post('/consultar-profesor', 'testController@pickTeacher');



Route::auth();
 
/* ADMIN */
Route::get('/crear-primer-admin', 'DashboardController@createFirstAdminForm');

Route::post('/almacenarAdmin', 'DashboardController@createAdmin');

Route::post('/dashboard/addUser', 'DashboardController@addUser');


Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/mostrar-usuarios', 'DashboardController@showUsers');
Route::post('/dashboard/mostrar-rol', 'DashboardController@showRol');
Route::get('/dashboard/mostrar-rol', 'DashboardController@showUsers');

/*Crud de usuarios*/

Route::get('/dashboard/crear-usuario', 'DashboardController@showCreateUserForm');
Route::get('/dashboard/editarUsuario/{id}', 'DashboardController@editUserForm');
Route::post('/dashboard/editar-usuario', 'DashboardController@editUser');




Route::get('/dashboard/eliminar-usuario/{id}', 'DashboardController@deleteUserMessage');
Route::post('/dashboard/confirmar-eliminacion', 'DashboardController@deleteConfirm');

Route::post('/dashboard/remover-usuario/{id}', 'DashboardController@removeUser');


/*Encuesta*/


Route::get('/dashboard/elegir-crear-encuesta', 'DashboardController@showCreateSurveyFormPick');

Route::post('/dashboard/elegir-creacion-encuesta', 'DashboardController@pickSurveyCreation');

Route::get('/dashboard/elegir-creacion-encuesta', function (){
    return back();
});


Route::get('/dashboard/crear-encuesta', 'DashboardController@showCreateSurveyForm');

Route::post('/dashboard/almacenar-encuesta', 'DashboardController@createSurvey');

Route::post('/dashboard/crear-encuesta-editada', 'DashboardController@createEditSurvey');


Route::get('/dashboard/mostrar-encuestas', 'DashboardController@showSurvey');

Route::get('/dashboard/seleccionar-encuesta/{id}', 'DashboardController@selectSurvey');

Route::get('/dashboard/seleccionar-edicion-encuesta/{id_semester}/{id_survey}', 'DashboardController@selectEditSurvey');


Route::get('/dashboard/editar-encuesta-form', 'DashboardController@editSurveyForm');

Route::post('/dashboard/editar-encuesta', 'DashboardController@editSurvey');


Route::get('/dashboard/mostrar-preguntas/{id}', 'DashboardController@showQuestionsForm');

Route::get('/dashboard/editar-preguntas/{id}', 'DashboardController@editQuestionsForm');

Route::post('/dashboard/editar-preguntas', 'DashboardController@editQuestions');

Route::get('/dashboard/eliminar-encuesta/{id}', 'DashboardController@deleteSurvey');

Route::get('/dashboard/inicio-encuesta', 'DashboardController@sendSurveyButton');

Route::post('/dashboard/enviar-encuesta', 'DashboardController@sendSurvey');

Route::get('/dashboard/llenar-encuesta/{token}/{id}', 'SurveyController@makeSurvey');

Route::post('/dashboard/empezar-encuesta', 'SurveyController@startSurvey');

/*Route::get('/dashboard/empezar-encuesta', function()
{
    return view('survey.startSurvey');
});*/

Route::post('/dashboard/guardar-encuesta', 'SurveyController@storeSurvey');



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


/*Rutas para directores, decanos, coordinadores */

Route::get('/interna', 'InternalController@index');

Route::get('/elegir-evaluacion-usuario', 'InternalController@pickUserEvaluation');

/*Mostrar gráficas */

Route::post('/get_chart', 'InternalController@showChart');

/*Actualizar opciones de gráficas*/

Route::post('/update_knowledgeArea', 'InternalController@updateKnowledgeArea');

Route::post('/update_subKnowledgeArea', 'InternalController@updateSubKnowledgeArea');

Route::post('/update_subject', 'InternalController@updateSubject');

Route::post('/update_teacher', 'InternalController@updateTeacher');


Route::get('/redirect', function (){
    return back();
});