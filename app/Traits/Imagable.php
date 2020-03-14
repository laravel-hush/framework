<?php

namespace ScaryLayer\Hush\Traits;

use ScaryLayer\Hush\Helpers\Image;

trait Imagable
{
    public function setAttribute($property, $value)
    {
        if (in_array($property, $this->imagable)) {
            $this->attributes[$property] = Image::store($value, $property);
            return $this->attributes[$property];
        }

        return parent::setAttribute($property, $value);
    }
}
