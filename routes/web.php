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
Route::resource('surveys', 'SurveyController')->middleware('auth');
Route::resource('response', 'ResponseController')->middleware('auth');