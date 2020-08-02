<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $id;
    public $multiple;
    public $name;
    public $value;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($name, $multiple = false, $value = '')
    {
        $this->id = $multiple
            ? $this->attributes['id'] ?? 'multiple-image'
            : $this->attributes['id'] ?? $name ?? 'image';
        $this->multiple = $multiple;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->multiple
            ? view('hush::components.inputs.file-multiple')
            : view('hush::components.inputs.file');
    }
}
