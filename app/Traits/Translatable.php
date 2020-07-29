<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait Translatable
{
    use Hushable;

    public function translations()
    {
        return $this->hasMany(
            $this->getTranslationModel(),
            $this->translatable_related
        );
    }

    public function getAttribute($property)
    {
        $parent = parent::getAttribute($property);
        return !$parent && in_array($property, $this->translatable)
            ? $this->translate($property)
            : $parent;
    }

    public function createTranslationTable()
    {
        Schema::create($this->getTranslatableTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger($this->getTranslatableRelated());
            $table->string('lang', 190);
            $table->string('field');
            $table->text('value');
            $table->timestamps();

            $table->foreign($this->getTranslatableRelated())
                ->references('id')
                ->on($this->table)
                ->onDelete('cascade');
            $table->foreign('lang')
                ->references('code')
                ->on('languages')
                ->onDelete('cascade');
        });

        return $this;
    }

    public function saveTranslation($field, $values)
    {
        if (!$values) {
            return false;
        }

        foreach ($values as $lang => $value) {
            $row = $this->translations()->firstOrNew([
                'field' => $field,
                'lang' => $lang
            ]);
            $row->value = $value ?? '';
            $row->save();
        }

        return true;
    }

    public function saveTranslations($data, $fields = null)
    {
        $data = collect($data)->only($fields ?? $this->translatable);
        foreach ($data as $field => $values) {
            $this->saveTranslation($field, $values);
        }
    }

    public function translate($field, $lang = null)
    {
        $row = $this->translations
            ->where('lang', $lang ?? app()->getLocale())
            ->where('field', $field)
            ->first();

        return optional($row)->value;
    }

    public function translationArray($field)
    {
        return $this->translations
            ->where('field', $field)
            ->pluck('value', 'lang');
    }

    private function getTranslationModel()
    {
        $path = '\\' . $this->getCurrentNamespace() . '\\Translatable\\';
        return $path . $this->getCurrentClass() . 'Translation';
    }

    private function getTranslatableRelated()
    {
        return $this->translatable_related ?? Str::of($this->getCurrentClass())->lower() . '_id';
    }

    private function getTranslatableTable()
    {
        return $this->translatable_table ?? Str::of($this->getCurrentClass())->lower() . '_translations';
    }
}
