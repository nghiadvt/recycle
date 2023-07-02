<?php

namespace App\Services\Admin;

use App\Models\GarbageType;
use App\Models\DamagedMissingReport;
use Illuminate\Support\Str;
use App\Traits\ResultPaginateTrait;

class DamagedMissingService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param DamagedMissingReport $damagedMissing The DamageMissingReport object to be assigned to the $model property.
     */
    public function __construct(DamagedMissingReport $damagedMissing)
    {
        $this->model = $damagedMissing;
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
        ->create($data)
        ->load('report')
        ->load('containerGarbageType.garbageType:id,name');
    }

    /**
     * Update a report by id
     * @param array $data The data to update
     * @param int $id The id of the report to update
     * @return mixed

     */
    public function update($data, $id)
    {
        $report = $this->model->with('containerGarbageType.garbageType:id,name')->find($id);
        if (!$report) {
            return null;
        }

        $report->fill($data);
        $report->save();

        return $report;
    }
}
