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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('site', 'SiteController');
Route::get('warehouseStock', 'WarehouseController@index')->name('warehouseStock');
Route::get('warehouseInventory', 'WarehouseController@inventory')->name('warehouseInventory');
Route::post('warehouseInventory', 'WarehouseController@save')->name('saveWarehouseInventory');
Route::get('/getsubcategory', 'CategoryController@getSubCategory')->name('getSubCategory');