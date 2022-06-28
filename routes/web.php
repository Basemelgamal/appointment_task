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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth','prefix'=>'admin','as'=>'dashboard.'], function(){
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
    Route::resource('/appointments', 'App\Http\Controllers\Admin\AppointmentController')->except('show');
    Route::get('/appointments/getDataTable', 'App\Http\Controllers\Admin\AppointmentController@getDatatable')->name('appointments.datatable');
});
Route::get('/appointments', 'App\Http\Controllers\AppointmentController@index')->middleware('auth');
