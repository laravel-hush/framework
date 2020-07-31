<?php

namespace ScaryLayer\Hush\Traits;

trait Hushable
{
    /**
     * Get current class name.
     *
     * @return string
     */
    protected function getCurrentClass(): string
    {
        $parts = explode('\\', get_called_class());
        return end($parts);
    }

    /**
     * Get current namespace.
     *
     * @return string
     */
    protected function getCurrentNamespace(): string
    {
        return explode('\\' . $this->getCurrentClass(), get_called_class())[0];
    }
}