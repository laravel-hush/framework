<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Support\Str;
use ScaryLayer\Hush\Helpers\Image;

trait Imagable
{
    public function setAttribute($property, $value)
    {
        if (in_array($property, $this->imagable)) {
            $parts = explode('\\', __CLASS__);
            $this->attributes[$property] = Image::store($value, Str::snake(end($parts)));
            return $this->attributes[$property];
        }

        return parent::setAttribute($property, $value);
    }
}
