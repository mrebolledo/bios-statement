<?php

Route::namespace('DBS')->group(function() {
    //Pyramid
    Route::namespace('Pyramid')->group(function () {
        //pyramid
        Route::namespace('Controllers')->group(function () {
            Route::resource('pyramids','PyramidController');
            //configurations
            Route::get('pyramids/configuration/{pyramid_id}','PyramidConfigurationController@index')->name('pyramids.configuration');
            Route::post('pyramids/configuration/{pyramid_id}','PyramidConfigurationController@store')->name('pyramids.configuration-store');
            //integrations
            Route::get('pyramid/{pyramid_id}/integrations','PyramidIntegrationsController@index')->name('pyramids.integrations');
            Route::get('integrations/pyramid-to-pyramid','PyramidIntegrationsController@pyramidToPyramid');
            Route::get('integrations/zone-to-zone','PyramidIntegrationsController@zoneToZone');
            Route::get('integrations/level-to-level','PyramidIntegrationsController@levelToLevel');
        });
        //level
        Route::namespace('Level')->group(function () {
            Route::namespace('Controllers')->group(function () {
                Route::resource('pyramid-levels','PyramidLevelController')->only([
                    'index','create','store','edit','update','destroy'
                ]);
            });
            //sectors
            Route::namespace('Sector')->group(function () {
                Route::namespace('Controllers')->group(function () {
                    Route::resource('sectors','SectorController');
                });
            });

        });
    });

    Route::namespace('Zone\Controllers')->group(function () {
        Route::resource('zones','ZoneController');
    });
});
