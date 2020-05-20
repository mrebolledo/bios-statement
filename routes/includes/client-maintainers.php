<?php


Route::namespace('Client')->group(function() {
    //Collaborator
    Route::namespace('Collaborator\Controllers')->group(function () {
        //Collaborator-Type
        Route::resource('collaborator-types','CollaboratorTypeController');
        //Collaborator
        Route::resource('collaborators','CollaboratorController');
    });
    //enterprises
    Route::namespace('Enterprise\Controllers')->group(function () {
        Route::resource('enterprises','EnterpriseController');
    });
});
