<?php

Route::get('datatable/{entity}',function($entity){
    $controller = app()->make('App\Http\DataTable\Controllers\\'. str_replace(' ','',ucwords(str_replace('-',' ',\Illuminate\Support\Str::singular($entity))))."DataTableController" );
    return $controller->callAction('getData',['request' => \Illuminate\Http\Request::capture(),'entity' => $entity]);
});
