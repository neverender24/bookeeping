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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/**
 * USER's ROUTE
 */
Route::get('get-user', 'UserController@get_current_user');
Route::post('users', 'UserController@index');
Route::post('store_users', 'UserController@store_users');
Route::patch('update_users', 'UserController@update_users');
Route::post('edit_user', 'UserController@edit_user');
Route::post('delete_user', 'UserController@delete_user');

/**
 * PPMP's ROUTE
 */
Route::prefix('ppmp')->group(function () {
    Route::post('index', 'PpmpController@index');
    Route::post('store', 'PpmpController@store');
    Route::patch('update', 'PpmpController@update');
    Route::post('edit', 'PpmpController@edit');
    Route::post('delete', 'PpmpController@delete');
});
/**
 * PPMP ITEMS ROUTE
 */
Route::prefix('ppmp/items')->group(function () {
    Route::post('index', 'PpmpItemController@index');
    Route::post('store', 'PpmpItemController@store');
    Route::patch('update', 'PpmpItemController@update');
    Route::post('edit', 'PpmpItemController@edit');
    Route::post('delete', 'PpmpItemController@delete');
});

Route::prefix('employee')->group(function () {
    Route::post('index', 'EmployeeController@index');
    Route::post('store', 'EmployeeController@store');
    Route::post('edit', 'EmployeeController@edit');
    Route::patch('update', 'EmployeeController@update');
    Route::post('delete', 'EmployeeController@delete');
});
Route::prefix('jevh')->group(function (){
    Route::post('index', 'JevhController@index');
});
