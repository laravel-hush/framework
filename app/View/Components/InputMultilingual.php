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
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type, $name, $multirow = false, $values = [])
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

    public function getClassField()
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
