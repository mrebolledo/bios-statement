<?php

Route::namespace('DBS')->group(function() {
    //Pyramid
    Route::namespace('Pyramid')->group(function () {
        //pyramid
        Route::namespace('Controllers')->group(function () {
            Route::resource('pyramids','PyramidController');
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
