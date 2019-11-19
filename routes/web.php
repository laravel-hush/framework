<?php

Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('/', function () {
        return view('hush::index');
    });

});