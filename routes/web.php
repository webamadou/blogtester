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

Route::get('/', "ProductsController@index");
//Route::get('/', "HomeController@index");

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/create', 'ProductsController@create')->name('create_product')->middleware('auth');

Route::post("/product/store", "ProductsController@store")->name('store_product');

Route::get("/product/edit/{id}", "ProductsController@edit")->name('edit_product');

Route::patch("/product/edit/{id}", "ProductsController@update")->name('edit_product');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('sellers', 'SellersController@registerProduct')->middleware('auth');
});