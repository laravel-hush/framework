<?php

namespace ScaryLayer\Hush\Traits;

trait Sortable
{
    public function scopeSort($query)
    {
        $fillable = in_array(request()->sort, $this->fillable ?? [])
            || in_array(request()->sort, ['id', 'created_at', 'updated_at']);
        if (request()->sort && $fillable) {
            return $query->orderBy(request()->sort, request()->direction);
        }
    }
}
