<?php

namespace ScaryLayer\Hush\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $action;
    public $method;

    /**
     * Create new Form instance
     *
     * @return void
     */
    public function __construct($action = null, $method = 'get')
    {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('hush::components.form');
    }

    /**
     * Check if field has images
     *
     * @return void
     */
    public function hasImages()
    {
        return (bool) $this->attributes['has-images'] ?? false;
    }

    /**
     * Get enctype for supporting image uploading
     *
     * @return void
     */
    public function imagesEnctype()
    {
        return 'multipart/form-data';
    }
}