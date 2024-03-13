<?php

use Illuminate\Support\Facades\Route;

Route::get('import/excel', 'ImportController@create')->name('import.excel.create');
Route::post('import/excel', 'ImportController@store')->name('import.excel.store');
Route::get('download/{id}', 'ImportController@download')->name('download');

Route::get('/', 'WorkstationController@index')->name('home');
Route::resource('workstations', 'WorkstationController')->only(['show']);

Route::resource('users', 'UserController')->only(['index']);

