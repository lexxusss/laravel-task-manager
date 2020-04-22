<?php

use App\Http\Middleware\UserIsInTeam;
use App\Http\Middleware\UserIsAdminOfTeam;

Auth::routes();

Route::middleware('auth')->group(function ($router) {
    Route::get('/', 'HomeController@index')->name('root');
    Route::get('home', 'HomeController@index')->name('home');

    Route::resource('team/{team}/tasks', 'TasksController')
        ->middleware(UserIsInTeam::class)
        ->names(['index' => 'tasks']);

    Route::resource('teams', 'TeamsController')
        ->middleware(UserIsAdminOfTeam::class)
        ->names(['create' => 'new_team', 'edit' => 'edit_team']);
    Route::get('teams', 'HomeController@index')->name('teams');

    Route::resource('team/{team}/collaborators', 'CollaboratorsController')
        ->middleware(UserIsAdminOfTeam::class)
        ->names(['index' => 'collaborators', 'create' => 'new_collaborator', 'edit' => 'edit_collaborator']);
});
