<?php

namespace App\Services;

use App\Models\Page;

class TermService
{
    protected $model;

    /**
     * Constructor function for the TermService class.
     *
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Get all data for terms of service screen
     *
     * @param array $columns
     *
     * @return object
     */
    public function getTermOfService(array $columns): object
    {
        $defaultColumns = $this->model::COLUMNS;

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model->where('type', $this->model::TERMS_OF_SERVICE)
            ->orWhere('type', $this->model::NONE)
            ->active()
            ->select($selectedColumns ?: $defaultColumns)
            ->get();
    }

    /**
     * Get all data for privacy policy screen
     *
     * @param array $columns
     *
     * @return object
     */
    public function getPrivacyPolicy(array $columns): object
    {
        $defaultColumns = $this->model::COLUMNS;

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model->where('type', $this->model::PRIVACY_POLICY)
            ->active()
            ->select($selectedColumns ?: $defaultColumns)
            ->get();
    }
}
