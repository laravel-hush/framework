<?php

Route::prefix('admin')->as('admin.')->group(function () {

    Route::prefix('docs')->as('docs.')->group(function () {
        Route::view('/', 'hush::docs.inputs');
    });

    Route::get('/', function () {
        return view('hush::index');
    });

});