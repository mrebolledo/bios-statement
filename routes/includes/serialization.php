<?php

//menus
Route::namespace('System\Menu')->group(function () {
    Route::namespace('Controllers')->group(function () {
        Route::get('menu/serialization','MenuSerializationController@serializeView')->name('menus.serialization');
        Route::post('menu/serialization','MenuSerializationController@store')->name('menus.store-serialization');
    });
});
//PyramidLevels
Route::namespace('DBS\Pyramid')->group(function () {
    Route::namespace('Level\Controllers')->group(function () {
        Route::get('pyramid-levels/serialization','PyramidLevelSerializationController@serializeView')->name('pyramid-levels.serialization');
        Route::post('pyramid-levels/serialization','PyramidLevelSerializationController@store')->name('pyramid-levels.store-serialization');
    });
});
