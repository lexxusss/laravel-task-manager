<?php

use App\Http\Middleware\UserIsAdminOfTeam;
use App\Http\Middleware\UserIsInTeam;

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

    Route::prefix('team/{team}/collaborators')
        ->middleware(UserIsAdminOfTeam::class)
        ->group(function ($router) {
            Route::get('/', 'CollaboratorsController@index')->name('collaborators');
            Route::post('/', 'CollaboratorsController@store')->name('store_collaborator');
            Route::get('/create', 'CollaboratorsController@create')->name('create_collaborator');
            Route::patch('/{userTeam}', 'CollaboratorsController@update')->name('update_collaborator');
            Route::get('/{userTeam}', 'CollaboratorsController@edit')->name('edit_collaborator');
            Route::get('/{userTeam}/delete', 'CollaboratorsController@destroy')->name('destroy_collaborator');

            Route::post('{userTeam}/send_invitation', function(\App\Model\Team $team) {})->name('send_invitation');
        });
});

// invitation
Route::get('accept_invitation_form', function() {})->name('accept_invitation_form');
// /invitation
