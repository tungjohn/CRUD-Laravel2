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

Route::get('/', 'Backend\DashboardController@index');

Route::get('/backend/product/index', 'Backend\ProductsController@index');

Route::get('/backend/product/create', 'Backend\ProductsController@create');

Route::get('/backend/product/edit/{id}', 'Backend\ProductsController@edit');

Route::get('/backend/product/delete/{id}', 'Backend\ProductsController@delete');

Route::post('/backend/product/store', 'Backend\ProductsController@store');

Route::post('/backend/product/update/{id}', 'Backend\ProductsController@update');

Route::get('/backend/product/remove/{id}', 'Backend\ProductsController@remove');
/*End ProductsController */

/* CategorysController */
Route::get('/backend/category/index', 'Backend\CategorysController@index');

Route::get('/backend/category/create', 'Backend\CategorysController@create');

Route::get('/backend/category/edit/{id}', 'Backend\CategorysController@edit');

Route::get('/backend/category/delete/{id}', 'Backend\CategorysController@delete');

Route::post('/backend/category/store', 'Backend\CategorysController@store');

Route::post('/backend/category/update/{id}', 'Backend\CategorysController@update');

Route::get('/backend/category/destroy/{id}', 'Backend\CategorysController@destroy');
/* End CategorysController */

/* OderController */

Route::get('/backend/orders/index', 'Backend\OrderController@index');

Route::get('/backend/orders/create', 'Backend\OrderController@create');

Route::get('/backend/orders/edit/{id}', 'Backend\OrderController@edit');

Route::get('/backend/orders/delete/{id}', 'Backend\OrderController@delete');

Route::post('/backend/orders/store', 'Backend\OrderController@store');

Route::post('/backend/orders/update/{id}', 'Backend\OrderController@update');

Route::post('/backend/orders/destroy/{id}', 'Backend\OrderController@destroy');

Route::post('/backend/orders/searchProduct', "Backend\OrderController@searchProduct");

Route::post('/backend/orders/ajaxSingleProduct', "Backend\OrderController@ajaxSingleProduct");