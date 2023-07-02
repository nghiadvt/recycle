<?php

namespace App\Services\Admin;

use App\Models\ReportApp;
use App\Models\DamagedMissingReport;
use Illuminate\Support\Str;
use App\Traits\ResultPaginateTrait;

class ReportAppService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param ReportApp $reportApp The ReportApp object to be assigned to the $model property.
     */
    public function __construct(ReportApp $reportApp)
    {
        $this->model = $reportApp;
    }

    /**
     * method store
     *
     * @param array $data
     * @return mixed
     */
    public function store($data)
    {
        return  $this->model
        ->create($data);
    }

    /**
     * method get
     *
     * @param int $limit
     * @return mixed
     */
    public function get($limit)
    {
        $reportApp = $this->model
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($reportApp);
    }
}
