<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;
use ScaryLayer\Hush\Helpers\Image;

class CommonController extends Controller
{
    public function searchView()
    {
        return view('hush::components.modals.search');
    }

    public function upload()
    {
        $path = Image::store(request()->file, 'wysiwyg');

        return [
            'status' => 'success',
            'path' => $path
        ];
    }
}
