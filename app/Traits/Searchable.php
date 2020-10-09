<?php

namespace ScaryLayer\Hush\Traits;

trait Searchable
{
    public function scopeSearch($query)
    {
        if (!$this->searchable || !request()->search) {
            return $query;
        }

        $query = $query->where(function ($query) {
            foreach ($this->searchable as $column) {
                if ($this->translatable && in_array($column, $this->translatable)) {
                    $query = $query->orWhereHas('translations', function ($query) use ($column) {
                        return $query->where('field', $column)
                            ->where('value', 'like', '%' . request()->search . '%');
                    });
                    continue;
                }

                if (mb_strpos($column, '.') !== false) {
                    $relation = explode('.', $column)[0];
                    $query = $this->searchNested(
                        $query,
                        $relation,
                        explode("$relation.", $column)[1]
                    );
                    continue;
                }

                $query = $query->orWhere("{$this->table}.$column", 'like', '%' . request()->search . '%');
            }
        });

        return $query;
    }

    /**
     * Search in nested columns
     *
     * @param mixed $query
     * @param string $relation
     * @param string $column
     * @return mixed
     */
    public function searchNested($query, string $relation, string $column)
    {
        return $query->orWhereHas($relation, function ($queryNested) use ($column) {
            if (mb_strpos($column, '.') !== false) {
                $relation = explode('.', $column)[0];
                $queryNested = $this->searchNested(
                    $queryNested,
                    $relation,
                    explode("$relation.", $column)[1]
                );
            } else {
                $queryNested->where($column, 'like', '%' . request()->search . '%');
            }
        });
    }
}
