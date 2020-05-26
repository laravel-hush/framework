<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait Translatable
{
    public function translations()
    {
        return $this->hasMany($this->getTranslationModel(), $this->translatable_related, 'id');
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
        Schema::create($this->translatable_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger($this->translatable_related);
            $table->string('lang', 190);
            $table->string('field');
            $table->text('value');
            $table->timestamps();

            $table->foreign($this->translatable_related)->references('id')->on($this->table);
            $table->foreign('lang')->references('code')->on('languages');
        });
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
            $row->value = $value;
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
            ->get()
            ->pluck('value', 'lang');
    }

    private function getCurrentClass()
    {
        $parts = explode('\\', get_called_class());
        return end($parts);
    }

    private function getCurrentNamespace()
    {
        return explode('\\' . $this->getCurrentClass(), get_called_class())[0];
    }

    private function getTranslationModel()
    {
        $path = '\\' . $this->getCurrentNamespace() . '\\Translations\\';
        return $path . $this->getCurrentClass() . 'Translation';
    }
}
