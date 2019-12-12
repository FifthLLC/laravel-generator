<?php

use Illuminate\Support\Facades\Route;


Route::get('', 'DashboardController@index')->name('dashboard');
Route::get('gui-generator', 'GuiGeneratorController@index')->name('generator');
Route::resource('model', 'ModelController');
