<?php

use App\Controllers\FormController;
use App\Http\Route;

Route::get('/', 'FormController@index');
Route::post('/send_form', 'FormController@store');
