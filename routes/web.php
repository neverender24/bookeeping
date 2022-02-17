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

Route::prefix('jevh')->group(function (){
    Route::post('index', 'JevhController@index');
    Route::post('export', 'JevhController@export');
});

Route::prefix('jevd')->group(function (){
    Route::post('index', 'JevdController@index');
    Route::post('jevDetails', 'JevdController@jevDetails');

});

Route::prefix('fundDetails')->group(function (){
    Route::get('getFundDetails', 'FundDetailsController@getFundDetails');
});

Route::post('get-funds', 'FundController@getAllFunds');
Route::post('get-fund-details', 'FundDetailsController@getFundDetails');