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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes(['register' => false]);

Route::group(['prefix' => 'company', 'middleware'=> 'auth'],function (){
    Route::get('index', 'App\Http\Controllers\CompanyController@index')->name('company.index');
    Route::get('create', 'App\Http\Controllers\CompanyController@create')->name('company.create');
    Route::post('store', 'App\Http\Controllers\CompanyController@store')->name('company.store');
    Route::get('{id}/edit', 'App\Http\Controllers\CompanyController@edit')->name('company.edit');
    Route::Post('{id}/update', 'App\Http\Controllers\CompanyController@update')->name('company.update');
    Route::delete('{id}/delete', 'App\Http\Controllers\CompanyController@destroy')->name('company.delete');


});
//employee routes
Route::group(['prefix' => 'employee', 'middleware'=> 'auth'],function (){
    Route::get('index', 'App\Http\Controllers\EmployeeController@index')->name('employee.index');
    Route::get('create', 'App\Http\Controllers\EmployeeController@create')->name('employee.create');
    Route::post('store', 'App\Http\Controllers\EmployeeController@store')->name('employee.store');
    Route::get('{id}/edit', 'App\Http\Controllers\EmployeeController@edit')->name('employee.edit');
    Route::Post('{id}/update', 'App\Http\Controllers\EmployeeController@update')->name('employee.update');
    Route::delete('{id}/delete', 'App\Http\Controllers\EmployeeController@destroy')->name('employee.delete');


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
