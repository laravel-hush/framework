<?php

namespace ScaryLayer\Hush\Traits;

trait Hushable
{
    protected function getCurrentClass()
    {
        $parts = explode('\\', get_called_class());
        return end($parts);
    }

    protected function getCurrentNamespace()
    {
        return explode('\\' . $this->getCurrentClass(), get_called_class())[0];
    }
}