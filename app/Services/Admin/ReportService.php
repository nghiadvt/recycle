<?php

namespace App\Services\Admin;

use App\Traits\ResultPaginateTrait;
use App\Models\Report;

class ReportService
{
    use ResultPaginateTrait;

    protected $model;

     /**
     * Constructor for initializing the model object.
     *
     * @param Report $report The Report object to be assigned to the $model property.
     */
    public function __construct(Report $report)
    {
        $this->model = $report;
    }

    /**
     * stored function
     *
     * @param array $data
     * @return mixed
     */
    public function stores($data)
    {
        return $this->model->create($data);
    }
}
