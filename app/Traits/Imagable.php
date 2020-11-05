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
        if ($value) {
            if (in_array($property, $this->imagable ?? []) && !is_string($value)) {
                $this->attributes[$property] = $this->saveImage($value);
                return $this->attributes[$property];
            }

            if (in_array($property, $this->imagable_multiple ?? [])) {
                foreach ($value as $image) {
                    $this->images()->create([
                        'field' => $property,
                        'image' => !is_string($image)
                            ? $this->saveImage($image)
                            : $image
                    ]);
                }
            }
        }

        return parent::setAttribute($property, $value);
    }

    /**
     * Create table for storing multiple images.
     *
     * @return mixed
     */
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

    /**
     * Construct imagable model name.
     *
     * @return string
     */
    private function getImagableModel(): string
    {
        $path = '\\' . $this->getCurrentNamespace() . '\\Imagable\\';
        return $path . $this->getCurrentClass() . 'Image';
    }

    /**
     * Construct related column name for multiple images table.
     *
     * @return string
     */
    private function getImagableRelated(): string
    {
        return $this->imagable_related
            ?? Str::of($this->getCurrentClass())->lower() . '_id';
    }

    /**
     * Construct multiple images table name.
     *
     * @return string
     */
    private function getImagableTable(): string
    {
        return $this->imagable_table
            ?? Str::of($this->getCurrentClass())->lower() . '_images';
    }

    /**
     * Remove one from multiple image by its field name and value.
     *
     * @param string $field
     * @param string $image
     * @return void
     */
    public function removeImage(string $field, string $image): void
    {
        $this->images()
            ->where('field', $field)
            ->where('image', $image)
            ->delete();
    }

    /**
     * Store uploaded file.
     *
     * @param mixed $image
     * @return string
     */
    public function saveImage($image): string
    {
        $parts = explode('\\', __CLASS__);
        $name = Str::snake(Str::plural(end($parts)));
        return Image::store($image, $name);
    }
}
