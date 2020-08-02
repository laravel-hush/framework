<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;
use ScaryLayer\Hush\Models\Language;

class InputMultilingual extends Component
{
    public $field_width;
    public $langs;
    public $multirow;
    public $name;
    public $slugify;
    public $type;
    public $values;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($type, $name, $values = [])
    {
        $this->langs = Language::getList();
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
        $this->field_width = $this->attributes['field-width'] ?? "col-12";
        $this->multirow = $this->attributes['multirow'] ?? false;
        $this->slugify = $this->attributes['slugify'] ?? false;

        return $this->multirow
            ? view("hush::components.inputs.multilingual.$this->type-multirow")
            : view("hush::components.inputs.multilingual.$this->type");
    }
}
