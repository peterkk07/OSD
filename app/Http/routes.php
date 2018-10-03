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

Route::get('/chartPdf', 'ChartController@index');

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
Route::get('/dashboard/mostrar-rol-usuario', 'DashboardController@showRol');
Route::get('/dashboard/mostrar-rol', 'DashboardController@showUsers');

Route::get('/dashboard/mostrar-rol-test', 'DashboardController@showRolTest');



/*Crud de usuarios*/

Route::get('/dashboard/crear-usuario', 'DashboardController@showCreateUserForm');
Route::get('/dashboard/editarUsuario/{id}', 'DashboardController@editUserForm');
Route::post('/dashboard/editar-usuario', 'DashboardController@editUser');

Route::get('/dashboard/editarUsuarioActual/{id}', 'DashboardController@editLoginUserForm');
Route::post('/dashboard/editar-usuario-actual', 'DashboardController@editLoginUser');



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

/*Route::get('/dashboard/eliminar-encuesta/{id}', 'DashboardController@deleteSurvey');*/

Route::get('/dashboard/eliminar-encuesta/{id}', 'DashboardController@deleteSurveyMessage');

Route::post('/dashboard/confirmar-eliminacion-encuesta', 'DashboardController@deleteSurveyConfirm');




Route::get('/dashboard/inicio-encuesta', 'DashboardController@sendSurveyButton');

Route::post('/dashboard/enviar-encuesta', 'DashboardController@sendSurvey');

Route::get('/dashboard/llenar-encuesta-inicio/{token}/{id}', 'SurveyController@makeSurveyHome');

Route::get('/dashboard/llenar-encuesta/{token}/{id}', 'SurveyController@makeSurvey');

Route::get('/dashboard/finalizar-encuesta/{token}/{id}', 'SurveyController@endSurvey');

Route::get('/dashboard/finalizar-encuesta', 'SurveyController@endSurveyView');




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

Route::get('/dashboard/ver-sub-areas', 'DashboardController@viewSubKnowledgeAreas');

Route::get('/dashboard/ver-materia/{id}', 'DashboardController@viewSubject');

Route::get('/dashboard/ver-materia-sub-area/{id}', 'DashboardController@viewSubAreaSubject');

Route::get('/dashboard/editar-materias/{id}', 'DashboardController@editSubjectForm');

Route::get('/dashboard/editar-materias-sub-areas/{id}', 'DashboardController@editSubjectSubAreaForm');


Route::post('/dashboard/agregar-materias', 'DashboardController@editSubject');

Route::post('/dashboard/agregar-materias-sub-areas', 'DashboardController@editSubjectSubArea');


/*
Route::get('/dashboard/eliminar-materia/{id}', 'DashboardController@deleteSubject');
*/
Route::get('/dashboard/eliminar-materia-area/{id}', 'DashboardController@deleteAreaSubject');

Route::post('/dashboard/confirmar-eliminacion-materia-area', 'DashboardController@deleteSubjectAreaConfirm');


/*Route::get('/dashboard/eliminar-materia-sub-areas/{id}', 'DashboardController@deleteSubjectSubArea');*/


Route::get('/dashboard/eliminar-materia-sub-area/{id}', 'DashboardController@deleteSubAreaSubject');

Route::post('/dashboard/confirmar-eliminacion-materia-sub-area', 'DashboardController@deleteSubjectSubAreaConfirm');



Route::get('/dashboard/eliminar-area/{id}', 'DashboardController@deleteArea');


Route::get('/dashboard/eliminar-area/{id}', 'DashboardController@deleteAreaMessage');

Route::post('/dashboard/confirmar-eliminacion-area', 'DashboardController@deleteAreaConfirm');

/*Route::get('/dashboard/eliminar-sub-area/{id}', 'DashboardController@deleteSubArea');*/

Route::get('/dashboard/eliminar-sub-area/{id}', 'DashboardController@deleteSubAreaMessage');

Route::post('/dashboard/confirmar-eliminacion-sub-area', 'DashboardController@deleteSubAreaConfirm');


/*Rutas para directores, decanos, coordinadores */

Route::get('/interna', 'InternalController@index');

Route::get('/elegir-evaluacion-usuario', 'InternalController@pickUserEvaluation');

Route::get('/elegir-evaluacion-comparacion-usuario', 'InternalController@pickCompareUserEvaluation');

Route::get('/elegir-evaluacion-comparacion-area-usuario', 'InternalController@pickCompareAreaUserEvaluation');


Route::get('/elegir-evaluacion-comparacion-area', 'InternalController@pickCompareAreaEvaluation');

Route::get('/elegir-evaluacion-comparacion-sub-area', 'InternalController@pickCompareSubAreaEvaluation');


Route::get('/elegir-evaluacion-comparacion-profesor', 'InternalController@pickCompareTeacherIndividual');

Route::get('/elegir-evaluacion-usuario-area', 'InternalController@pickUserArea');

Route::get('/elegir-evaluacion-usuario-sub-area', 'InternalController@pickUserSubArea');

Route::get('/elegir-evaluacion-profesor', 'InternalController@pickTeacherEvaluation');



Route::get('/elegir-evaluacion-area', 'InternalController@pickKnowledgeAreaEvaluation');

Route::get('/elegir-evaluacion-sub-area', 'InternalController@pickSubKnowledgeAreaEvaluation');




/*Mostrar gráficas */

/*Grafica evaluación individual*/
Route::post('/get_chart', 'InternalController@showChart');


/*Grafica evaluación Area de Conocimiento*/
Route::post('/get_chart_area', 'InternalController@showChartArea');

/*Grafica evaluación Sub Area de Conocimiento*/
Route::post('/get_chart_sub_area', 'InternalController@showChartSubArea');


/*Grafica evaluación del profesor*/
Route::post('/get_chart_teacher', 'InternalController@showChartTeacher');


/*Grafica comparacion de profesor*/
Route::post('/get_chart_compare_teacher', 'InternalController@compareChartTeacher');

/*Grafica comparacion individual de profesor*/
Route::post('/get_chart_compare_individual_teacher', 'InternalController@compareChartIndividualTeacher');


/*Grafica comparacion de Areas*/
Route::post('/get_chart_compare_area', 'InternalController@compareChartArea');

/*Grafica comparacion de Sub Areas*/
Route::post('/get_chart_compare_sub_area', 'InternalController@compareChartSubArea');








/*Actualizar opciones de gráficas*/

Route::post('/update_knowledgeArea', 'InternalController@updateKnowledgeArea');

Route::post('/update_subKnowledgeArea', 'InternalController@updateSubKnowledgeArea');

Route::post('/update_subject', 'InternalController@updateSubject');

Route::post('/update_teacher', 'InternalController@updateTeacher');

Route::post('/update_questions', 'InternalController@updateQuestion');

Route::post('/update_teacher_options', 'InternalController@updateTeacherOptions');



/* Reportes*/

Route::get('/reportes-profesores', 'ReportController@reportTeacherForm');

Route::post('/reporte-profesor', 'ReportController@createReportTeacher');

Route::get('/reportes-profesores-individual', 'ReportController@reportIndividualTeacherForm');


Route::get('/reportes-areas', 'ReportController@reportAreaForm');

Route::get('/reportes-sub-areas', 'ReportController@reportSubAreaForm');

Route::post('/reporte-area', 'ReportController@createReportArea');

Route::post('/reporte-sub-area', 'ReportController@createReportSubArea');




Route::get('/redirect', function (){
    return back();
});


Route::get('/redirectHome', function (){
    return redirect()->to('/interna');
});