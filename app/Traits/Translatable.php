<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait Translatable
{
    public function __get($property)
    {
        $parent = parent::__get($property);
        return $parent ?? $this->translate($property);
    }

    public function translations()
    {
        return $this->hasMany('\\' . $this->getCurrentNamespace() . '\\Translations\\' . $this->getCurrentClass() . 'Translation', $this->translatable_related, 'id');
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
        foreach ($values as $lang => $value) {
            $row = $this->translations()->firstOrNew([
                $this->translatable_related => $this->id,
                'field' => $field,
                'lang' => $lang
            ]);
            $row->value = $value;
            $row->save();
        }
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
        return optional($this->translations
            ->where('lang', $lang ?? app()->getLocale())
            ->where('field', $field)
            ->first())->value;
    }

    private function getCurrentNamespace()
    {
        $class = $this->getCurrentClass();
        return explode('\\' . $class, get_called_class())[0];
    }

    private function getCurrentClass()
    {
        $parts = explode('\\', get_called_class());
        return end($parts);
    }
}
