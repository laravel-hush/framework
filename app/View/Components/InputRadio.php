<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class InputRadio extends Component
{
    public $is_checked;
    public $name;
    public $value;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($name, $isChecked, $value = 1)
    {
        $this->name = $name;
        $this->is_checked = $isChecked;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('hush::components.inputs.radio');
    }
}
