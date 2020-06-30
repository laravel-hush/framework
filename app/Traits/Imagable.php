<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Support\Str;
use ScaryLayer\Hush\Helpers\Image;

trait Imagable
{
    public function setAttribute($property, $value)
    {
        if (in_array($property, $this->imagable ?? []) && !is_string($value)) {
            $this->attributes[$property] = $this->saveImage($value);
            return $this->attributes[$property];
        }

        if ($value && in_array($property, $this->imagable_multiple ?? [])) {
            foreach ($value as $image) {
                if (!is_string($image)) {
                    $this->{$this->imagable_relation}()->create([
                        'image' => $this->saveImage($image)
                    ]);
                }
            }
        }

        return parent::setAttribute($property, $value);
    }

    public function saveImage($image)
    {
        $parts = explode('\\', __CLASS__);
        return Image::store($image, Str::snake(end($parts)));
    }
}
