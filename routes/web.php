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
Route::get('/dashboard/project/add', function () {
    return view('project.add');
});

Route::post('/project-add', 'ProjectController@add')->name('project-add');

// Редактирование проекта
Route::get('/dashboard/project/{id}', 'ProjectController@index')->name('project');

Route::post('/project-update', 'ProjectController@update')->name('project-update');

//Сегменты
Route::get('/dashboard/project/{id}/segment', 'SegmentController@index')->name('segments');

Route::get('/dashboard/project/{id}/segment/add', 'SegmentController@add_form')->name('segment-add-form');

Route::post('/segment-add', 'SegmentController@add')->name('segment-add');

Route::get('/dashboard/project/{id}/segment/{segment_id}', 'SegmentController@show')->name('segment');

//Эксперименты
Route::get('/dashboard/project/{id}/experiment', 'SegmentController@index')->name('experiment');

Route::get('/dashboard/project/{id}/experiment/add', function () {
    return view('experiment.add');
});