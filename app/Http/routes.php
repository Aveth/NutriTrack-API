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

Route::get('food/category/{category}', 'FoodController@category');
Route::get('food/search/{query}', 'FoodController@search');
Route::get('food/details/{id}', 'FoodController@details');
Route::get('food/nutrients', 'FoodController@nutrients');
Route::get('food/categories', 'FoodController@categories');

Route::post('user/register', 'UserController@register');
Route::post('user/authenticate', 'UserController@authenticate');
Route::get('user/profile/{token}', 'UserController@profile');

Route::get('user/nutrients/view/{token}', 'NutrientsController@view');
Route::post('user/nutrients/edit/{token}', 'NutrientsController@edit');

Route::get('user/meals/view/{token}', 'MealController@view');
Route::post('user/meals/add/{token}', 'MealController@add');
Route::post('user/meals/edit/{token}', 'MealController@edit');
Route::post('user/meals/delete/{token}', 'MealController@delete');
