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

Route::post('/segment-update', 'SegmentController@update')->name('segment-update');

//Страницы
Route::get('/dashboard/project/{id}/page', 'PageController@index')->name('pages');

Route::get('/dashboard/project/{id}/page/add', 'PageController@add_form')->name('page-add-form');

Route::post('/page-add', 'PageController@add')->name('page-add');

Route::get('/dashboard/project/{id}/page/{page_id}', 'PageController@show')->name('page');

Route::post('/page-update', 'PageController@update')->name('page-update');

//Эксперименты
Route::get('/dashboard/project/{id}/experiment', 'ExperimentController@index')->name('experiments');

Route::get('/dashboard/project/{id}/experiment/add', 'ExperimentController@add_form')->name('experiment-add-form');

Route::post('/experiment-add', 'ExperimentController@add')->name('experiment-add');

Route::get('/dashboard/project/{id}/experiment/{experiment_id}', 'ExperimentController@show')->name('experiment');

Route::post('/experiment-update', 'ExperimentController@update')->name('experiment-update');

//Результаты
Route::get('/dashboard/project/{id}/experiment/{experiment_id}/results', 'ResultsController@index')->name('results');