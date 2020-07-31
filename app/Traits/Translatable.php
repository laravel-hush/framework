<?php

namespace ScaryLayer\Hush\Traits;

use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Create table for storing translation strings.
     *
     * @return mixed
     */
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

    /**
     * Save translatable field values.
     *
     * @param string $field
     * @param array $values
     * @return bool
     */
    public function saveTranslation(string $field, array $values): bool
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

    /**
     * Save translations for all available fields.
     *
     * @param array $data
     * @param mixed array
     * @return void
     */
    public function saveTranslations(array $data, array $fields = null): void
    {
        $data = collect($data)->only($fields ?? $this->translatable);
        foreach ($data as $field => $values) {
            $this->saveTranslation($field, $values);
        }
    }

    /**
     * Translate field for given language.
     *
     * @param string $field
     * @param string $lang
     * @return string
     */
    public function translate(string $field, string $lang = null): string
    {
        $row = $this->translations
            ->where('lang', $lang ?? app()->getLocale())
            ->where('field', $field)
            ->first();

        return optional($row)->value;
    }

    /**
     * Return list of all translations for given field.
     *
     * @param string $field
     * @return Collection
     */
    public function translationArray(string $field): Collection
    {
        return $this->translations
            ->where('field', $field)
            ->pluck('value', 'lang');
    }

    /**
     * Get translation model name.
     *
     * @return string
     */
    private function getTranslationModel(): string
    {
        $path = '\\' . $this->getCurrentNamespace() . '\\Translatable\\';
        return $path . $this->getCurrentClass() . 'Translation';
    }

    /**
     * Get related field name.
     *
     * @return string
     */
    private function getTranslatableRelated(): string
    {
        return $this->translatable_related
            ?? Str::of($this->getCurrentClass())->lower() . '_id';
    }

    /**
     * Get translation table name.
     *
     * @return string
     */
    private function getTranslatableTable(): string
    {
        return $this->translatable_table
            ?? Str::of($this->getCurrentClass())->lower() . '_translations';
    }
}
