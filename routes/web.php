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


/**
 *
 ** Home Controller
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');




/**
 * * Survey Controller routes
 */
Route::resource('surveys', 'SurveyController')->middleware('auth');
Route::get('surveys/destroy/{id}', 'SurveyController@destroy')->name('surveys.destroy')->middleware('auth');




/**
 * * Response Controller Routes
 */
Route::resource('response', 'ResponseController')->middleware('auth');
Route::get('/response/submit/success', 'ResponseController@success')->name('successResponse');
Route::get('/response/submit/fail', 'ResponseController@fail')->name('failResponse');



/**
 * * Auth Routes
 */
Auth::routes();

/**
 *
 * * Profile controller routes
 */
Route::get('/profile', 'ProfileController@getProfile')->name('profile')->middleware('auth');
Route::get('/profile/edit', 'ProfileController@getProfileEdit')->name(
    'edit.profile'
)->middleware('auth');
Route::post('/profile/edit', 'ProfileController@postProfileEdit')->name(
    'edit.profile'
)->middleware('auth');
Route::post('/profile/delete/{id}', 'ProfileController@deleteProfile')->name(
    'profile.delete'
)->middleware('auth');


/**
 * * Market Place Routes
 */
Route::get('/market', 'MarketController@index')
    ->name('market')
    ->middleware('auth');
Route::get('/market/buy/{id}', 'MarketController@buyItemPasswordConfirmForm')
    ->name('market.buy')
    ->middleware('auth');

Route::post('/market/purchase', 'MarketController@buyItem')
    ->name('market.purchase')
    ->middleware('auth');



/**
 * * Admin Routes
 */
Route::get('/admin', 'AdminController@index')
    ->name('admin')
    ->middleware('auth');

/**
 * * Admin Market Routes
 */
Route::get('/admin/market', 'AdminController@getMarketItemAll')
    ->name('admin.get.market')
    ->middleware('auth');
Route::get('/admin/market/edit/{id}', 'AdminController@editMarketItem')
    ->name('admin.market.edit.item')
    ->middleware('auth');
Route::get('/admin/market/create/', 'AdminController@createMarketItem')
    ->name('admin.market.create.item')
    ->middleware('auth');
Route::post('/admin/market/save', 'AdminController@postMarketItem')
    ->name('admin.market.post.item')
    ->middleware('auth');
Route::post('/market/delete/{id}', 'AdminController@deleteItem')
    ->name('admin.market.item.delete')
    ->middleware('auth');


/**
 * * Admin Category Routes
 */
Route::get('/admin/categories', 'AdminController@getCategoriesAll')
    ->name('admin.get.categories')
    ->middleware('auth');
Route::get('/admin/categories/create', 'AdminController@createCategory')
    ->name('admin.create.categories')
    ->middleware('auth');
Route::get('/admin/categories/edit/{id}', 'AdminController@editCategory')
    ->name('admin.edit.category')
    ->middleware('auth');
Route::post('/admin/category/save', 'AdminController@postCategory')
    ->name('admin.category.post')
    ->middleware('auth');
Route::post('/admin/category/delete/{id}', 'AdminController@deleteCategory')
    ->name('admin.category.delete')
    ->middleware('auth');
