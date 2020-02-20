<?php

Route::prefix('admin')->as('admin.')->namespace('ScaryLayer\\Hush\\Controllers')->group(function () {

    Route::prefix('docs')->as('docs.')->group(function () {
        Route::view('/', 'hush::docs.inputs');
    });

    Route::get('/', function () {
        return view('hush::index');
    })->name('index');

    Route::view('login', 'hush::login');

    Route::get('{url}', 'GlobalController@construct')
        ->where('url', '([A-Za-z0-9\-\/]+)')
        ->name('constructor');

    Route::delete('{url}', 'GlobalController@process')
        ->where('url', '([A-Za-z0-9\-\/]+)')
        ->name('constructor.process');
    Route::patch('{url}', 'GlobalController@process')
        ->where('url', '([A-Za-z0-9\-\/]+)')
        ->name('constructor.process');
    Route::post('{url}', 'GlobalController@process')
        ->where('url', '([A-Za-z0-9\-\/]+)')
        ->name('constructor.process');
    Route::put('{url}', 'GlobalController@process')
        ->where('url', '([A-Za-z0-9\-\/]+)')
        ->name('constructor.process');

});
