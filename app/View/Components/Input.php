<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $value;

    /**
     * Create new Input instance
     *
     * @param string $type
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __construct(string $type, string $name, $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->type == 'textarea'
            ? view('hush::components.inputs.textarea')
            : view('hush::components.inputs.input');
    }
}
