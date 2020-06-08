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

Auth::routes();

Route::post('/follow/{user}', 'FollowsController@store');

Route::post('/p', 'PostsController@store');
Route::get('/p/create', 'PostsController@create');

// Route::get('/deals', 'DealsController@store');

Route::get('/deals', 'DealFieldController@index');

Route::get('/config/deals/add', 'DealsController@store');
Route::get('/config/deals/update', 'DealFieldController@update');
Route::get('/config/deals/', 'DealsController@index');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
