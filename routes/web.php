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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/insert','SupInsertController@index')->name('supplier form');
//Route::post('/create','SupInsertController@store')->name('supplier form create');

//--------------------- supplier -----------------------------//
Route::get('/supplier', 'SupInsertController@index')->name('supplier.index');
Route::get('/supplier/add', 'SupInsertController@create')->name('supplier.add');
Route::post('/supplier/add', 'SupInsertController@store')->name('supplier.store');
Route::get('/supplier/edit/{id}','SupInsertController@edit')->name('supplier.edit');
Route::post('/supplier/update','SupInsertController@update')->name('supplier.update');
Route::get('/supplier/destroy/{id}','SupInsertController@destroy');

//--------------------- product -------------------------------//
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/product/add', 'ProductController@create')->name('product.add');
Route::post('/product/add','ProductController@store')->name('product.store');
Route::get('/product/edit/{id}','ProductController@edit')->name('product.edit');
Route::post('/product/update','ProductController@update')->name('product.update');
Route::get('/product/destroy/{id}','ProductController@destroy');


//Route::post('/product/create', 'ProductController@store');

//Route::get('/supplier', 'SupInsertController@index')->name('supplier.index');
//Route::post('/supplier', 'SupInsertContr  oller@show')->name('supplier table view');m
//Route::resource('/supplier', 'SupInsertController');
//Route::resource('/product', 'ProductController');



