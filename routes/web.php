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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Создание проекта
Route::get('/new-project', function () {
    return view('project.add');
});

Route::post('/project-add', 'ProjectController@add')->name('project-add');

// Редактирование проекта
Route::get('/dashboard/project/{id}', 'ProjectController@index')->name('project');

Route::post('/project-update', 'ProjectController@update')->name('project-update');
