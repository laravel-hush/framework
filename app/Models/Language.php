<?php

namespace ScaryLayer\Hush\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['code', 'name'];

    /**
     * Get list of languages from cache
     *
     * @return Collection
     */
    public static function getList(): Collection
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