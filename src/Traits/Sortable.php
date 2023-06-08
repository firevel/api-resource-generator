<?php

namespace Firevel\ApiResourceGenerator\Traits;

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
    public function scopeSort($query, array $sortingAttributes)
    {
        $sortingAttributes = array_intersect_key($this->sortable, $sortingAttributes);

        if (empty($sortingAttributes)) {
            return $query;
        }

        foreach ($sortingAttributes as $attribute) {
            $sortingDirection = strpos($attribute, '-') === 0 ? 'desc' : 'asc';

            $query->orderBy(Str::slug($attribute, '_'), $sortingDirection);
        }

        return $query;
    }
}
