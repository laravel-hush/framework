<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public $is_checked;
    public $name;
    public $value;

    /**
     * Create new InputCheckbox instance
     *
     * @param string $name
     * @param bool $isChecked
     * @param mixed $value
     * @return void
     */
    public function __construct(string $name, bool $isChecked, $value = 1)
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
        return view('hush::components.inputs.checkbox');
    }
}
