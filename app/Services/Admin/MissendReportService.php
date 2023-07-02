<?php

namespace App\Services\Admin;

use App\Models\GarbageType;
use App\Models\MissendReport;
use Illuminate\Support\Str;
use App\Traits\ResultPaginateTrait;

class MissendReportService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param MissendReport $missendReport The MissendReport object to be assigned to the $model property.
     */
    public function __construct(MissendReport $missendReport)
    {
        $this->model = $missendReport;
    }

    /**
     * get function
     *
     * @param int $limit
     * @return mixed
     */
    public function get($limit)
    {
        $missendReport = $this->model
            ->with('report')
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($missendReport);
    }

    /**
     * stored function
     *
     * @param array $data
     * @return mixed
     */
    public function store($data)
    {
        $data['garbage_type'] = implode(",", $data['garbage_type']);
        return  $this->model->create($data)->load('report');
    }

    /**
     * Show the report with the specified id, along with its associated garbage types.
     *
     * @param int $id The id of the report to be shown.
     * @return mixed
     * If the report exists, return the report with its associated garbage types.
     * If the report does not exist, return null.
     */
    public function show($id)
    {
        // Find the report with the specified id, along with its associated report data.
        $missendReport = $this->model->with('report')->find($id);
        if (!$missendReport) {
            // If the report does not exist, return null.
            return null;
        }
        // Extract the garbage type ids from the comma-separated string.
        $garbageType_ids = explode(',', $missendReport['garbage_type']);
        // Query the garbage type table to retrieve information about the associated garbage types.
        $garbageTypes = GarbageType::whereIn('id', $garbageType_ids)
            ->get();
        // Create an array of the garbage type information for the report to be returned.
        $garbageTypeData = [];
        foreach ($garbageTypes as $garbageType) {
            $garbageTypeData[] = [
                'id' => $garbageType->id,
                'name' => $garbageType->name,
            ];
        }
        // Replace the comma-separated string with an array of garbage type information in the report.
        $missendReport['garbage_type'] = $garbageTypeData;

        return $missendReport;
    }

    /**
     * Update a report by id
     * @param array $data The data to update
     * @param int $id The id of the report to update
     * @return mixed

     */
    public function update($data, $id)
    {
        $data['garbage_type'] = implode(",", $data['garbage_type']);
        $report = $this->model->with('report')->find($id);
        if (!$report) {
            return null;
        }

        $report->fill($data);
        $report->save();

        return $report;
    }
}
