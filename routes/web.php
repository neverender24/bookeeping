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
    Route::post('jevdTotal', 'JevdController@jevdTotal');
});

Route::prefix('fundDetails')->group(function (){
    Route::get('getFundDetails', 'FundDetailsController@getFundDetails');
});

Route::post('get-fund-details', 'FundDetailsController@getFundDetails');

// crud of jevd
Route::post('get_all_details', 'JevdController@getAllDetails');
Route::post('getjDetails', 'JevdController@getJDetails');
Route::post('getDetailsSubcode', 'JevdController@getDetailsSubcode');
Route::post('store_jdetails', 'JevdController@store_jdetails');
Route::post('edit_jdetails', 'JevdController@edit_jdetails');
Route::post('update_jdetails', 'JevdController@update_jdetails');
Route::post('delete_details', 'JevdController@delete_details')->name('delete_details');
Route::get('export-jevd', 'JevdController@exportJevd');
