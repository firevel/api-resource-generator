<?php

namespace Firevel\ApiResourceGenerator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiRequest extends FormRequest
{
    /* Default pagination page size */
    const DEFAULT_PAGE_SIZE = 20;

    /**
     * Cached model.
     *
     * @var object
     */
    protected $model;

    /**
     * Get model related with request basing on children getModelClass method.
     *
     * If possible resolve it.
     *
     * @return object
     */
    public function getModel()
    {
        if (empty($this->model)) {
            $model = app($this->getModelClass());

            $parameter = $this
                ->route()
                ->parameter(
                    str_singular($model->getTable())
                );
            if (is_object($parameter) && $this->getModelClass() == get_class($parameter)) {
                $model = $parameter;
            }
            $this->model = $model;
        }

        return $this->model;
    }

    /**
     * Get base name of model class.
     *
     * @return string
     */
    public function getModelClassBasename()
    {
        $baseName = class_basename($this->getModelClass());

        return strtolower($baseName);
    }

    /**
     * Get includes array.
     *
     * @return array
     */
    public function getInclude()
    {
        if ($this->has('include')) {
            $include = explode(',', $this->input('include'));
            $include = array_map(
                function ($item) {
                    return camel_case($item);
                },
                $include
            );
        }

        return [];
    }

    /**
     * Get fields allowed for filtering.
     *
     * @return array
     */
    public function getFields()
    {
        $table = $this->getModel()->getTable();
        if ($this->input('fields.'.$table)) {
            $fields = explode(',', $this->input('fields.'.$table));
            // Always include id in fields list
            if (! in_array('id', $fields)) {
                $fields[] = 'id';
            }

            return $fields;
        }

        return ['*'];
    }

    /**
     * Get sort options.
     *
     * @return array
     */
    public function getSort()
    {
        if ($this->has('sort')) {
            return explode(',', $this->input('sort'));
        }

        return [];
    }

    /**
     * Get fillable fields of model.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->getModel()->getFillable();
    }

    /**
     * Get pagination size.
     *
     * @return array
     */
    public function getPageSize()
    {
        if ($this->has('page.size')) {
            return $this->input('page.size');
        }
        return self::DEFAULT_PAGE_SIZE;
    }
}
