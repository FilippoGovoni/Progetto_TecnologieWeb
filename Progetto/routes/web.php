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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('client','ClientController',['all']); 
Route::resource('admin','AdminController',['only',['index','create','store','destroy']]);
Route::get('/research', 'ProjectController@research');
Route::get('/ore_progetto', 'ProjectController@ore_progetto');
Route::get('/assegna/{id}', 'ProjectController@assegna');
Route::get('/elimina_user_assegnato/{id}/{user_id}', 'ProjectController@elimina_user_assegnato');
Route::resource('project','ProjectController',['all']);
Route::resource('schedaore','SchedaoreController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
