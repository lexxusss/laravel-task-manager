<?php

Route::get('/', 'HomeController@index')->name('root');
Route::get('home', 'HomeController@index')->name('home');

Auth::routes();

