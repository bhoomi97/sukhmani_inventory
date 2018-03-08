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

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('site', 'SiteController');
	Route::resource('category', 'CategoryController');
	Route::resource('subcategory', 'SubCategoryController');
	Route::resource('vendor', 'VendorController');
	Route::get('warehouseStock', 'WarehouseController@index')->name('warehouseStock');
	Route::get('logwarehouseStock', 'LogWarehouseController@index')->name('logwarehouseStock');
	Route::get('warehouseInventory', 'WarehouseController@inventory')->name('warehouseInventory');
	Route::post('warehouseInventory', 'WarehouseController@save')->name('saveWarehouseInventory');
	Route::get('siteInventory', 'SiteStockController@inventory')->name('siteInventory');
	Route::post('siteInventory', 'SiteStockController@save')->name('siteInventory');
	Route::get('logsitestock', 'LogStockController@index')->name('logsitestock');
	Route::get('/getsubcategory', 'CategoryController@getSubCategory')->name('getsubcategory');
	Route::get('/getvendor', 'CategoryController@getVendor')->name('getvendor');
	Route::get('/getspecification', 'CategoryController@getSpecification')->name('getspecification');
	Route::get('/getsubcategoryrates', 'CategoryController@getSubCategoryRates')->name('getsubcategoryrates');
	Route::get('/getspecificationrates', 'CategoryController@getSpecificationRates')->name('getspecificationrates');
	Route::get('/getmaxquantity', 'CategoryController@getmaxquantity')->name('getmaxquantity');
});