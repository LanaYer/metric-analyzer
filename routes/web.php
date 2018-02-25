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

Route::get('/dashboard', [
    'middleware' =>  ['auth'],
    'uses' => 'DashboardController@index'
])->name('dashboard');


/*
    Создание проекта
*/
Route::get('/dashboard/project/add', function () {
    return view('project.add');
})->middleware(['auth']);

Route::post('/project-add', [
    'middleware' =>  ['auth'],
    'uses' => 'ProjectController@add'
])->name('project-add');


/*
    Редактирование проекта
*/
Route::get('/dashboard/project/{project}', ['middleware' =>  ['auth', 'user'], 'uses' => 'ProjectController@index'])
    ->name('project');

Route::post('/project-update', ['middleware' =>  ['auth', 'user'], 'uses' => 'ProjectController@update'])
    ->name('project-update');


/*
    Сегменты
*/
Route::group(['prefix' => '/dashboard/project/{project}/segment'], function () {

    Route::get('/', [
        'middleware' => ['auth', 'user'],
        'uses' => 'SegmentController@index'
    ])->name('segments');

    Route::get('/add', [
        'middleware' => ['auth', 'user'],
        'uses' => 'SegmentController@add_form'
    ])->name('segment-add-form');

    Route::get('/{segment}', [
        'middleware' =>  ['auth', 'user'],
        'uses' => 'SegmentController@show'
    ])->name('segment');

});

Route::post('/segment-add', ['middleware' =>  ['auth'], 'uses' => 'SegmentController@add'])
    ->name('segment-add');

Route::post('/segment-update',[ 'middleware' =>  ['auth'], 'uses' => 'SegmentController@update'])
    ->name('segment-update');


/*
    Страницы
*/

Route::group(['prefix' => '/dashboard/project/{project}/page'], function () {

    Route::get('/', [
        'middleware' => ['auth', 'user'],
        'uses' => 'PageController@index'
    ])->name('pages');

    Route::get('/add', [
        'middleware' => ['auth', 'user'],
        'uses' => 'PageController@add_form'
    ])->name('page-add-form');

    Route::get('/{page}', [
        'middleware' => ['auth', 'user'],
        'uses' => 'PageController@show'
    ])->name('page');

});

Route::post('/page-add', ['middleware' =>  ['auth'], 'uses' => 'PageController@add'])
    ->name('page-add');

Route::post('/page-update',[ 'middleware' =>  ['auth'], 'uses' => 'PageController@update'])
    ->name('page-update');



/*
    Эксперименты
*/

Route::group(['prefix' => '/dashboard/project/{project}/experiment'], function () {

    Route::get('/', [
        'middleware' =>  ['auth', 'user'],
        'uses' => 'ExperimentController@index'
    ])->name('experiments');

    Route::get('/add', [
        'middleware' =>  ['auth', 'user'],
        'uses' => 'ExperimentController@add_form'
    ])->name('experiment-add-form');

    Route::get('/{experiment}', [
        'middleware' =>  ['auth', 'user'],
        'uses' => 'ExperimentController@show'
    ])->name('experiment');

    Route::get('/{experiment}/results', [
        'middleware' =>  ['auth', 'user'],
        'uses' => 'ResultsController@index'
    ])->name('results');

    /*
    Этапы эксперимента
*/
    Route::group(['prefix' => '/{experiment}/step'], function () {

        Route::get('/', [
            'middleware' =>  ['auth', 'user'],
            'uses' => 'StepController@index'
        ])->name('steps');

        Route::get('/add', [
            'middleware' =>  ['auth', 'user'],
            'uses' => 'StepController@add_form'
        ])->name('step-add-form');

        Route::get('/{step}', [
            'middleware' =>  ['auth', 'user'],
            'uses' => 'StepController@show'
        ])->name('step');

    });
});

Route::post('/experiment-add', ['middleware' =>  ['auth'], 'uses' => 'ExperimentController@add'])
    ->name('experiment-add');

Route::post('/experiment-update',[ 'middleware' =>  ['auth'], 'uses' => 'ExperimentController@update'])
    ->name('experiment-update');

Route::post('/step-add', ['middleware' =>  ['auth'], 'uses' => 'StepController@add'])
    ->name('step-add');

Route::post('/step-update',[ 'middleware' =>  ['auth'], 'uses' => 'StepController@update'])
    ->name('step-update');