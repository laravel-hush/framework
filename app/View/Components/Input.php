<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\Support\Collection;
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
        if (in_array($this->type, ['checkbox', 'radio', 'select', 'textarea'])) {
            return view("hush::components.inputs.$this->type");
        }

        if ($this->type == 'file') {
            return $this->isMultiple()
                ? view('hush::components.inputs.file-multiple')
                : view('hush::components.inputs.file');
        }

        return view('hush::components.inputs.input');
    }

    /**
     * Get id of file field
     *
     * @return string
     */
    public function getFileId(): string
    {
        return $this->attributes['multiple']
            ? $this->attributes['id'] ?? 'multiple-image'
            : $this->attributes['id'] ?? $name ?? 'image';
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

    /**
     * Get options list for select
     *
     * @return array
     */
    public function getSelectOptions(): array
    {
        if (!isset($this->attributes['options'])) {
            return [];
        }

        $options = $this->attributes['options'];
        if (is_string($this->attributes['options'])) {
            $options = json_decode(html_entity_decode($options), true);
        }
        
        return $options ?? [];
    }

    /**
     * Check if input is multiple
     *
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->attributes['multiple'] ?? false;
    }

    /**
     * Check if option is selected
     *
     * @param mixed $value
     * @return bool
     */
    public function isSelected($value): bool
    {
        if ($this->value instanceof Collection) {
            $this->value = $this->value->all();
        }

        return is_array($this->value)
            ? in_array($value, $this->value)
            : $value == $this->value;
    }
}
