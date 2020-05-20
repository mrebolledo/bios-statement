<?php

//Auth
include_once 'includes/auth.php';
//DataTables
include_once 'includes/datatables.php';

Route::middleware('auth')->group(function () {
    //system
    include_once 'includes/system.php';
    //DBS
    include_once 'includes/dbs-maintainers.php';
    //Client
    include_once 'includes/client-maintainers.php';
    //Serialization
    include_once 'includes/serialization.php';
});



Route::get('mailable', function () {
    $collaborator = \App\Domain\Client\Collaborator\Collaborator::first();

    return new \App\Mail\Client\Extra\StatementMail($collaborator);
});
Route::view('declaracion','client.extra.statement');
Route::view('declaracion-enviada','client.extra.sended');

Route::post('statement','Client\Extra\StatementController@postStatement');
Route::get('findRut/{rut}','Client\Extra\StatementController@findRut');

Route::get('collaborators-statements','Client\Extra\StatementController@index')->name('collaboratorsStatements');
Route::get('collaborator/{id}/statements','Client\Extra\StatementController@list');
Route::get('verificar-codigo','Client\Extra\StatementController@verifyView');
Route::post('verificar-codigo','Client\Extra\StatementController@postCode');

Route::get('revocar-permisos','Schedule\Client\Extra\RevokePermissionsToCollaborators');
Route::get('validar-especies','Client\Extra\UpdatePyramidToWorkers');
