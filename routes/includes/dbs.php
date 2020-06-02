<?php

Route::namespace('DBS')->group(function() {
    //collaborator
    Route::namespace('Collaborator')->group(function () {
        Route::namespace('Controllers')->group(function () {
            Route::get('collaborator/{collaborator_id}/manage','CollaboratorManageController@index')->name('collaborator.manage');
        });
        Route::namespace('Movement')->group(function () {
            Route::namespace('Controllers')->group(function () {
                Route::get('collaborator/simulate-movements/{collaborator_id?}','CollaboratorMovementController@simulateView')->name('collaborator-movements.simulate-view');
                Route::post('collaborator/simulate-movements/{collaborator_id?}','CollaboratorMovementController@storeSimulation')->name('collaborator-movements.simulate-store');
            });
        });
    });
});
