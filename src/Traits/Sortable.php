<?php

namespace Firevel\ApiResourceGenerator\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait Sortable
 * @package Firevel\ApiResourceGenerator\Traits
 */
trait Sortable
{
    /**
     * Scope a query to sort results.
     *
     * @param Builder $query
     * @param array $sortingAttributes
     * @return Builder
     */
    public function scopeSort(Builder $query, array $sortingAttributes): Builder
    {
        foreach ($sortingAttributes as $attribute) {
            $sortingDirection = strpos($attribute, '-') === 0 ? 'desc' : 'asc';

            $query->orderBy(Str::slug($attribute, '_'), $sortingDirection);
        }

        return $query;
    }
}
