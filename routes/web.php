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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/response/success', 'ResponseController@success')->name('successResponse');
Route::get('/response/fail', 'ResponseController@fail')->name('failResponse');

Auth::routes();

Route::get('/profile', 'ProfileController@getProfile')->name('profile');
Route::get('/profile/edit', 'ProfileController@getProfileEdit')->name('edit.profile');
Route::post('/profile/edit', 'ProfileController@postProfileEdit')->name('edit.profile');
Route::resource('surveys', 'SurveyController')->middleware('auth');
Route::resource('response', 'ResponseController')->middleware('auth');

Route::get('/market', 'MarketController@index')->name('market')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin/market', 'AdminController@getMarketItemAll')->name('admin.get.market')->middleware('auth');
Route::get('/admin/market/edit/{id}', 'AdminController@editMarketItem')->name('admin.market.edit.item')->middleware('auth');
Route::get('/admin/market/create/', 'AdminController@createMarketItem')->name('admin.market.create.item')->middleware('auth');
Route::post('/admin/market/save', 'AdminController@postMarketItem')->name('admin.market.post.item')->middleware('auth');