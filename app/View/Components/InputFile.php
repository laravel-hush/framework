<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $id;
    public $multiple;
    public $name;
    public $preview;
    public $value;

    /**
     * Create new InputFile instance
     *
     * @param string $name
     * @param bool $multiple
     * @param bool $preview
     * @param mixed $value
     * @return void
     */
    public function __construct(string $name, $multiple = false, $preview = false, $value = '')
    {
        $this->id = $multiple
            ? $this->attributes['id'] ?? 'multiple-image'
            : $this->attributes['id'] ?? $name ?? 'image';
        $this->multiple = $multiple;
        $this->name = $name;
        $this->preview = $preview;
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
