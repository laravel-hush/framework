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
        if (in_array($this->type, ['checkbox', 'textarea'])) {
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
     * Check if input is multiple
     *
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->attributes['multiple'] ?? false;
    }
}
