<?php

namespace ScaryLayer\Hush\Helpers;

use Exception;

class Constructor
{
    public static function link($item)
    {
        $link = '#';
        if (isset($item['route'])) {
            $link = route($item['route']);
        } elseif (isset($item['constructor'])) {
            $link = route('admin.constructor', ['url' => str_replace('.', '/', $item['constructor'])]);
        } elseif (isset($item['link'])) {
            $link = $item['link'];
        }

        return $link;
    }
}