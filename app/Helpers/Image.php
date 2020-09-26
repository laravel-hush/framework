<?php

namespace ScaryLayer\Hush\Helpers;

class Image
{
    /**
     * Store uploaded file to given path
     *
     * @param mixed $file
     * @param string $savePath
     * @return string
     */
    public static function store($file, string $savePath): string
    {
        $filename = sha1(microtime()) . '.' . $file->getClientOriginalExtension();
        $destinationPath = config('hush.app.uploads-folder') . '/' . $savePath;

        $file->move(public_path($destinationPath), $filename);

        return '/' . $destinationPath . '/' . $filename;
    }
}
