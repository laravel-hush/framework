<?php

namespace ScaryLayer\Hush\Helpers;

use Illuminate\Support\Str;

class Image
{
    public static function store($file, $savePath)
    {
        $filename = sha1(microtime()) . '.' . $file->getClientOriginalExtension();
        $destinationPath = config('hush.app.uploads_folder') . '/' . $savePath;

        $file->move(public_path($destinationPath), $filename);

        return '/' . $destinationPath . '/' . $filename;

    }
}
