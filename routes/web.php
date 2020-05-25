<?php

Route::prefix('admin')
    ->as('admin.')
    ->middleware('web')
    ->namespace('ScaryLayer\\Hush\\Controllers')
    ->group(function () {

        Route::prefix('docs')->as('docs.')->group(function () {
            Route::view('/', 'hush::docs.inputs');
        });

        Route::middleware(function ($request, Closure $next) {
            return auth()->check()
                ? redirect(auth()->user()->permitted('admin') ? route('admin.index') : '/')
                : $next($request);
        })->group(function () {
            Route::view('login', 'hush::login')->name('login');
            Route::post('login', function () {
                if (Auth::attempt(request()->only('email', 'password'))) {
                    return redirect()->route('admin.index');
                }

                return back()->withErrors(['email' => __('hush::admin.admin-does-not-exists')]);
            })->name('login.post');
        });

        Route::middleware('permission:admin,admin.login')->group(function () {

            Route::view('search', 'hush::components.modals.search');

            Route::get('logout', function () {
                Auth::logout();
                return redirect()->route('admin.index');
            })->name('logout');

            Route::get('/', 'GlobalController@construct')->name('index');
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
    });
