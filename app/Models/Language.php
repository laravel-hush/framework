<?php

namespace ScaryLayer\Hush\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['code', 'name'];

    public static function getList()
    {
        return cache()->remember(
            'languages',
            24 * 60 * 60,
            function () {
                return Language::all();
            }
        )->keyBy('code');
    }
}