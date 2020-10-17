<?php

use Illuminate\Support\Facades\Route;

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

/* ProductsController */
Route::get('/backend/dashboard/home', 'Backend\ProductsController@home');

Route::get('/', 'Backend\DashboardController@index')->middleware('backendauth');

Route::get('/backend/product/index', 'Backend\ProductsController@index')->middleware('backendauth');

Route::get('/backend/product/create', 'Backend\ProductsController@create')->middleware('backendauth');

Route::get('/backend/product/edit/{id}', 'Backend\ProductsController@edit')->middleware('backendauth');

Route::get('/backend/product/delete/{id}', 'Backend\ProductsController@delete')->middleware('backendauth');

Route::post('/backend/product/store', 'Backend\ProductsController@store')->middleware('backendauth');

Route::post('/backend/product/update/{id}', 'Backend\ProductsController@update')->middleware('backendauth');

Route::get('/backend/product/remove/{id}', 'Backend\ProductsController@remove')->middleware('backendauth');
/*End ProductsController */

/* CategorysController */
Route::get('/backend/category/index', 'Backend\CategorysController@index')->middleware('backendauth');

Route::get('/backend/category/create', 'Backend\CategorysController@create')->middleware('backendauth');

Route::get('/backend/category/edit/{id}', 'Backend\CategorysController@edit')->middleware('backendauth');

Route::get('/backend/category/delete/{id}', 'Backend\CategorysController@delete')->middleware('backendauth');

Route::post('/backend/category/store', 'Backend\CategorysController@store')->middleware('backendauth');

Route::post('/backend/category/update/{id}', 'Backend\CategorysController@update')->middleware('backendauth');

Route::get('/backend/category/destroy/{id}', 'Backend\CategorysController@destroy')->middleware('backendauth');
/* End CategorysController */

/* OderController */

Route::get('/backend/orders/index', 'Backend\OrderController@index')->middleware('backendauth');

Route::get('/backend/orders/create', 'Backend\OrderController@create')->middleware('backendauth');

Route::get('/backend/orders/edit/{id}', 'Backend\OrderController@edit')->middleware('backendauth');

Route::get('/backend/orders/delete/{id}', 'Backend\OrderController@delete')->middleware('backendauth');

Route::post('/backend/orders/store', 'Backend\OrderController@store')->middleware('backendauth');

Route::post('/backend/orders/update/{id}', 'Backend\OrderController@update')->middleware('backendauth');

Route::post('/backend/orders/destroy/{id}', 'Backend\OrderController@destroy')->middleware('backendauth');

Route::post('/backend/orders/searchProduct', "Backend\OrderController@searchProduct")->middleware('backendauth');

Route::post('/backend/orders/ajaxSingleProduct', "Backend\OrderController@ajaxSingleProduct")->middleware('backendauth');

/* SETTINGS */

Route::get('/backend/settings', "Backend\SettingsController@edit")->middleware('backendauth');

Route::post('/backend/settings/update', "Backend\SettingsController@update")->middleware('backendauth');

/* ADMIN */

Route::get('/backend/admins/index',         'Backend\AdminController@index')->middleware('backendauth');
Route::get('/backend/admins/create',        'Backend\AdminController@create')->middleware('backendauth');
Route::get('/backend/admins/edit/{id}',      'Backend\AdminController@edit')->middleware('backendauth');
Route::get('/backend/admins/delete/{id}',    'Backend\AdminController@delete')->middleware('backendauth');
Route::post('/backend/admins/store',        'Backend\AdminController@store')->middleware('backendauth');
Route::post('/backend/admins/update/{id}',  'Backend\AdminController@update')->middleware('backendauth');
Route::post('/backend/admins/destroy/{id}', 'Backend\AdminController@destroy')->middleware('backendauth');

/* Authen Admin */
Route::get('/backend/admin-login', "Backend\AdminLoginController@loginview");
Route::post('/backend/admin-login', "Backend\AdminLoginController@loginPost");
Route::get('/backend/admin-logout','Backend\AdminLoginController@logout')->middleware('backendauth');

