<?php

namespace ScaryLayer\Hush\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['code', 'name'];
}