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
Route::resource('project','ProjectController',['only',['index','create','store','edit','update']]); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
