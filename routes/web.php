<?php

use Illuminate\Support\Facades\Route;

// homepage | list of all workstations
Route::get('/', 'RouteController@home')->name('home');
