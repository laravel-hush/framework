<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public $name;
    public $options;
    public $value;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($name, $options = [], $value = null)
    {
        $this->options = $options;
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
        return view('hush::components.inputs.select');
    }

    /**
     * Check if field has multiple attribute
     *
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->attributes['multiple'] ?? false;
    }

    public function isSelected($value): bool
    {
        if ($this->value instanceof Collection) {
            $this->value = $this->value->all();
        }

        return is_array($this->value)
            ? in_array($value, $this->value)
            : $value == $this->value;
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
