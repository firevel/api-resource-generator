<?php

namespace Firevel\ApiResourceGenerator\Traits;

trait Filterable
{
    /**
     * Default operator if no other operator detected.
     *
     * @var string
     */
    protected $defaultFilterOperator = '=';

    /**
     * Supported operators.
     *
     * @var array
     */
    protected $allowedFilterOperators = [
        '>=',
        '<=',
        '>',
        '<',
        '=',
    ];

    /**
     * Apply filters to query.
     *
     * @param  array  $filters  Filters formatted key => val or key => [operator => vale]
     * @param  Builder  $query
     * @return Builder
     */
    public function applyFiltersToQuery($filters, $query)
    {
        if (empty($this->filterable) || empty($filters)) {
            return $query;
        }

        $filterable = array_intersect_key($this->filterable, $filters);

        foreach ($filterable as $filterName => $filterType) {
            if (is_array($filters[$filterName])) {
                foreach ($filters[$filterName] as $operator => $filterValue) {
                    $operator = urldecode($operator);
                    if (! in_array($operator, $this->allowedFilterOperators)) {
                        throw new \Exception('Illegal operator '.$operator);
                    }
                    $this->applyFilterToQuery($filterType, $filterName, $filterValue, $operator, $query);
                }
            } else {
                $this->applyFilterToQuery($filterType, $filterName, $filters[$filterName], null, $query);
            }
        }
    }

    /**
     * Apply filter to query.
     *
     * @param  string  $filterType  Type
     * @param  string  $filterName  Name
     * @param  string  $filterValue  Value
     * @param  string|null  $operator  Operator ex.: >=
     * @param  Builder  $query
     *
     * @return Builder
     */
    public function applyFilterToQuery($filterType, $filterName, $filterValue, $operator, $query)
    {
        if (empty($operator)) {
            $operator = $this->defaultFilterOperator;
        }

        switch ($filterType) {
            case 'integer':
                return $query->where($filterName, $operator, $filterValue);
                break;
            case 'date':
                return $query->whereDate($filterName, $operator, $filterValue);
                break;
            case 'datetime':
                if (strlen($filterValue) == 10) {
                    return $query->whereDate($filterName, $operator, $filterValue);
                }

                return $query->where($filterName, $operator, $filterValue);
                break;
            case 'id':
                return $query->where($filterName, $operator, $filterValue);
                break;
            case 'string':
                return $query->where($filterName, $operator, $filterValue);
                break;
            default:
                throw new \Exception('Unsupported filter type '.$filterType);
        }
    }

    /**
     * Scope a query to apply filters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        if (empty($filters)) {
            return $query;
        }

        $this->applyFiltersToQuery($filters, $query);

        return $query;
    }
}
