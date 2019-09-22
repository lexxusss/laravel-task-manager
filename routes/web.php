<?php

use App\Http\Middleware\UserIsInTeam;
use App\Http\Middleware\UserIsAdminOfTeam;

Route::get('/', 'HomeController@index')->name('root');
Route::get('home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('team/{team}/tasks', 'TasksController')
    ->middleware(UserIsInTeam::class)
    ->names(['index' => 'tasks']);

Route::resource('teams', 'TeamsController')
    ->middleware(UserIsAdminOfTeam::class)
    ->names(['create' => 'new_team']);

