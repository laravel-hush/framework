<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ScaryLayer\Hush\Helpers\Image;

trait Imagable
{
    use Hushable;

    public function images()
    {
        return $this->hasMany(
            $this->getImagableModel(),
            $this->getImagableRelated()
        );
    }

    public function setAttribute($property, $value)
    {
        if (in_array($property, $this->imagable ?? []) && !is_string($value)) {
            $this->attributes[$property] = $this->saveImage($value);
            return $this->attributes[$property];
        }

        if ($value && in_array($property, $this->imagable_multiple ?? [])) {
            foreach ($value as $image) {
                $this->images()->create([
                    'field' => $property,
                    'image' => !is_string($image)
                        ? $this->saveImage($image)
                        : $image
                ]);
            }
        }

        return parent::setAttribute($property, $value);
    }
    
    public function createImagesTable()
    {
        Schema::create($this->getImagableTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger($this->getImagableRelated());
            $table->string('field');
            $table->string('image');
            $table->timestamps();

            $table->foreign($this->getImagableRelated())
                ->references('id')
                ->on($this->table)
                ->onDelete('cascade');
        });

        return $this;
    }

    private function getImagableModel()
    {
        $path = '\\' . $this->getCurrentNamespace() . '\\Imagable\\';
        return $path . $this->getCurrentClass() . 'Image';
    }

    private function getImagableRelated()
    {
        return $this->imagable_related
            ?? Str::of($this->getCurrentClass())->lower() . '_id';
    }

    private function getImagableTable()
    {
        return $this->imagable_table
            ?? Str::of($this->getCurrentClass())->lower() . '_images';
    }

    public function removeImage($field, $image)
    {
        $this->images()
            ->where('field', $field)
            ->where('image', $image)
            ->delete();
    }

    public function saveImage($image)
    {
        $parts = explode('\\', __CLASS__);
        return Image::store($image, Str::snake(end($parts)));
    }
}
