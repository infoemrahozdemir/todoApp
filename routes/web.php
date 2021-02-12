<?php

use Illuminate\Support\Facades\Route;

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

Route::get('tasks', 'TaskManagerController@index');
Route::get('new-task', 'TaskManagerController@create');
Route::post('store-task', 'TaskManagerController@store');
Route::get('tasks/{taskId}/edit','TaskManagerController@edit');
Route::post('tasks/{taskId}/update','TaskManagerController@update');
Route::get('tasks/{taskId}/delete','TaskManagerController@destroy');
Route::post('task-sortable','TaskManagerController@order');
