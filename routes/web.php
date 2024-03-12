<?php

use Illuminate\Support\Facades\Route;

// homepage | list of all workstations
Route::get('/', 'RouteController@home')->name('home');

Route::get('import/excel', 'ImportController@create')->name('import.excel.create');
Route::post('import/excel', 'ImportController@store')->name('import.excel.store');
