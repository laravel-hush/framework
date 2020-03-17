<?php

namespace ScaryLayer\Hush\Traits;

trait Searchable
{
    public function scopeSearch($query)
    {
        if (!$this->searchable || !request()->search) {
            return $query;
        }

        foreach ($this->searchable as $column) {
            if (mb_strpos($column, '.') !== false) {
                $relation = explode('.', $column)[0];
                $query = $this->searchNested($query, $relation, explode("$relation.", $column)[1]);
                continue;
            }

            $query = $query->orWhere($column, 'like', '%' . request()->search . '%');
        }

        return $query;
    }

    public function searchNested($query, $relation, $column)
    {
        return $query->orWhereHas($relation, function ($queryNested) use ($column) {
            if (mb_strpos($column, '.') !== false) {
                $relation = explode('.', $column)[0];
                $queryNested = $this->searchNested($queryNested, explode("$relation.", $column)[1]);
            } else {
                $queryNested->where($column, 'like', '%' . request()->search . '%');
            }
        });
    }
}
