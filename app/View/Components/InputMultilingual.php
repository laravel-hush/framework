<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;
use ScaryLayer\Hush\Models\Language;

class InputMultilingual extends Component
{
    public $langs;
    public $multirow;
    public $name;
    public $type;
    public $values;

    /**
     * Create new InputMultilingual instance
     *
     * @param string $type
     * @param string $name
     * @param bool $multirow
     * @param mixed $values
     * @return void
     */
    public function __construct(string $type, string $name, $multirow = false, $values = [])
    {
        $this->langs = Language::getList();
        $this->multirow = $multirow;
        $this->name = $name;
        $this->type = $type;
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->multirow
            ? view("hush::components.inputs.multilingual.$this->type-multirow")
            : view("hush::components.inputs.multilingual.$this->type");
    }

    /**
     * Get class attribute
     *
     * @return string
     */
    public function getClassAttribute(): string
    {
        return 'multilingual-field ' . ($this->attributes['class'] ?? '');
    }

    /**
     * Get field width attribute
     *
     * @return string
     */
    public function getFieldWidth(): string
    {
        return $this->attributes['field-width'] ?? 'col-12';
    }

    /**
     * Check if string is sluggable
     *
     * @return string|bool
     */
    public function isSluggable()
    {
        return $this->attributes['slugify'] ?? false;
    }

    /**
     * Get placeholder
     *
     * @return string
     */
    public function getPlaceholder(): string
    {
       return $this->attributes['placeholder'] ?? $this->attributes['label'] ?? '';
    }
}
