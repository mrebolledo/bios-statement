<?php


Route::namespace('Client')->group(function() {
    //Collaborator
    Route::namespace('Collaborator\Controllers')->group(function () {
        //Collaborator-Type
        Route::resource('collaborator-types','CollaboratorTypeController');
        //Collaborator
        Route::resource('collaborators','CollaboratorController');
        // Sectors
        Route::get('collaborator/{collaborator}/sectors','CollaboratorSectorsController@index')->name('collaborator.sectors');
        Route::post('collaborator/{collaborator}/sectors','CollaboratorSectorsController@store')->name('collaborator.sectors-store');
    });
    //enterprises
    Route::namespace('Enterprise\Controllers')->group(function () {
        Route::resource('enterprises','EnterpriseController');
    });
});
