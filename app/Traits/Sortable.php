<?php

namespace ScaryLayer\Hush\Traits;

trait Sortable
{
    public function scopeSort($query)
    {
        if (request()->sort && in_array(request()->sort, $this->sortable ?? [])) {
            return $query->orderBy(request()->sort, request()->direction);
        }
    }
}
