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
    return view('recipes.index');
});

Auth::routes();

Route::resource('recipes', 'RecipesController');
Route::resource('categories', 'CategoriesController');


Route::group(['namespace' => 'Api', 'prefix' => 'api/v1', 'as' => 'api.v1.'], function () {

    Route::resource('recipes', 'RecipeController');
    Route::get('categories/{term?}', 'CategoryController@index')->name('categories.index');

});
