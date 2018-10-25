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

Route::get('generator', 'FileGeneratorController@generator')->name('generator');

Route::get('check_convergance/{model}', 'FileGeneratorController@checkConvergance')->name('check_convergance/{name}');

Route::get('generate_excel/{model}', 'ModelExportController@generateExcel')->name('generate_excel/{name}');

Route::get('zip/{model}', 'FileGeneratorController@create_zip')->name('zip/{name}');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// models
Route::get('/list_models', 'GisModelsController@listModels')->name('list_models');
Route::get('/view_model/{modelName}', 'GisModelsController@viewModel')->name('view_model/{modelName}');
Route::get('/create_model', 'GisModelsController@createModel')->name('create_model');
Route::post('/create_model', 'GisModelsController@postCreateModel')->name('create_model');
