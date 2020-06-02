<?php


Route::namespace('System')->group(function () {
    //home
    Route::get('/', 'Main\Controllers\HomeController@home')->name('home');
    //users
    Route::namespace('User')->group(function () {
        Route::namespace('Controllers')->group(function () {
            Route::resource('users', 'UserController');
        });
    });
    //roles
    Route::namespace('Role')->group(function () {
        Route::namespace('Controllers')->group(function () {
            Route::resource('roles', 'RoleController');
            Route::get('role/{id}/permissions','RolePermissionsController@index')->name('roles.permissions');
            Route::post('role/{id}/permissions','RolePermissionsController@store')->name('roles.permissions-store');
        });
    });
    //permissions
    Route::namespace('Permission')->group(function () {
        Route::namespace('Controllers')->group(function () {
            Route::resource('permissions', 'PermissionController');
        });
    });
    //menus
    Route::namespace('Menu')->group(function () {
        Route::namespace('Controllers')->group(function () {
            Route::resource('menus','MenuController');
        });
    });
    //TEst
    Route::get('/test','Test\Controllers\TestController');
});

//components
Route::get('/getCombo',function(\Illuminate\Http\Request $request){
    return view('system.components.combo',[
        'label' => $request->label ?? null,
        'name' => $request->name ?? null,
        'display' => $request->display ?? 'name',
        'entity' => $request->entity ?? null,
        'filter' => $request->filter ?? null,
        'filterField' => $request->filterField ?? null,
        'functionNext' => $request->functionNext ?? false
    ]);
})->name('components.combo');
//userProfile
/* Route::get('profile', 'User\Profile\Controllers\UserProfileController@index')->name('user.profile');
 //userSettings
 Route::get('accountSettings', 'User\Settings\Controllers\UserSettingsController@index')->name('userSettings.index');
 Route::get('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@index')->name('userSettings.general');
 Route::post('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@update');
 Route::get('changePassword', 'User\Settings\Controllers\ChangePasswordController@index')->name('userSettings.changePassword');
 Route::post('changePassword', 'User\Settings\Controllers\ChangePasswordController@changePassword');

 //userProfile
 // Route::get('profile', 'User\Profile\Controllers\UserProfileController@index')->name('user.profile');
 //userSettings
 // Route::get('accountSettings', 'User\Settings\Controllers\UserSettingsController@index')->name('userSettings.index');
 //Route::get('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@index')->name('userSettings.general');
 //Route::post('accountGeneral', 'User\Settings\Controllers\AccountGeneralController@update');
 //Route::get('changePassword', 'User\Settings\Controllers\ChangePasswordController@index')->name('userSettings.changePassword');
 // Route::post('changePassword', 'User\Settings\Controllers\ChangePasswordController@changePassword');*/




/*Route::prefix('datatable/')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('menus', 'System\Menu\Controllers\MenuDatatableController@getData')->name('datatable.menus');
        Route::get('roles', 'System\Role\Controllers\RoleDatatableController@getData')->name('datatable.roles');
        Route::get('users', 'System\User\Controllers\UserDatatableController@getData')->name('datatable.users');
        Route::get('permissions', 'System\Permission\Controllers\PermissionDatatableController@getData')->name('datatable.permissions');
        Route::get('imports', 'System\Import\Import\Controllers\ImportDatatableController@getData')->name('datatable.imports');
        Route::get('change-logs', 'System\ChangeLog\Controllers\ChangeLogDatatableController@getData')->name('datatable.change-logs');
        Route::get('import-files/{slug}', 'System\Import\ImportFile\Controllers\ImportFileDatatableController@getData')->name('datatable.import-files');
        Route::get('queueImports', 'System\Import\Queue\Controllers\QueueImportDatatableController@getData')->name('datatable.queuedImports');

        Route::get('mails', 'System\Mail\Controllers\MailDatatableController@getData')->name('datatable.mails');
    });*/
