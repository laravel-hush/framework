<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    public function construct()
    {
        $route = str_replace('admin.', '', str_replace('/', '.', request()->path()));
        abort_if(!config('hush.pages.' . $route), 404);

        return view('hush::constructor.index', [
            'settings' => isset(config('hush.pages.' . $route)['blocks'])
                ? config('hush.pages.' . $route)
                : config('hush.pages.' . $route . '.index')
        ]);
    }
}