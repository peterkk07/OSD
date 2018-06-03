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
