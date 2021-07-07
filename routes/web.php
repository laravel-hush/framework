<?php

Route::prefix(config('hush.app.prefix', 'admin'))
    ->as('admin.')
    ->middleware('web')
    ->namespace('ScaryLayer\\Hush\\Controllers')
    ->group(function () {

        Route::middleware('redirect-admin')->group(function () {
            Route::get('login', 'LoginController@get')->name('login');
            Route::post('login', 'LoginController@post')->name('login.post');
        });

        Route::middleware('permission:admin,admin.login')->group(function () {

            Route::get('search', 'CommonController@searchView')->name('search');
            Route::get('logout', 'LogincController@logout')->name('logout');

            Route::post('upload-wysiwyg-image', 'CommonController@upload')
                ->name('upload-wysiwyg-image');

            Route::redirect('/', config('hush.app.index-page'))->name('index');

            Route::get('{url}', 'GlobalController@construct')
                ->where('url', '([A-Za-z0-9\-\/]+)')
                ->name('constructor');

            Route::delete('{url}', 'GlobalController@process')
                ->where('url', '([A-Za-z0-9\-\/]+)');
            Route::patch('{url}', 'GlobalController@process')
                ->where('url', '([A-Za-z0-9\-\/]+)');
            Route::post('{url}', 'GlobalController@process')
                ->where('url', '([A-Za-z0-9\-\/]+)')
                ->name('constructor.process');
            Route::put('{url}', 'GlobalController@process')
                ->where('url', '([A-Za-z0-9\-\/]+)');
        });
    });
