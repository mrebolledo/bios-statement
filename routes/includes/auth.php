<?php


Route::namespace('Auth\Controllers')->group(function () {
    //non-authenticated user
    Route::middleware('visitor')->group(function () {
        /*Login Route*/
        Route::view('login','auth.pages.login')->name('view.login');
        Route::post('login','LoginController@login')->name('login');
        /* Register Route*/
        Route::view('register','auth.pages.register')->name('view.register');
        Route::post('register','RegisterController@register')->name('register');
        /* Forgot Password Route */
        Route::view('forgot-password','auth.pages.passwords.email')->name('view.forgot-password');
        Route::post('forgot-password','ForgotPasswordController')->name('forgot-password');

    });
    //authenticated user
    Route::middleware('auth')->group(function(){
        /* Logout */
        Route::get('logout','LoginController@logout')->name('logout');
    });
});
