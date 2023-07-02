<?php

namespace App\Services;

use App\Models\ReportPlace;
use App\Jobs\ReplyReportPlaceEmailJob;

class ReportPlaceService
{
    protected $model;

    /**
     * Constructor function for the ReportService class.
     *
     * @param ReportPlace $model
     */
    public function __construct(ReportPlace $model)
    {
        $this->model = $model;
    }

    /**
     * Report place
     *
     * @param array $data
     *
     * @return bool
     */
    public function storeReportPlace(array $data): bool
    {
        // Get email from $data
        $email = $data['email'];
        $this->model->create($data);

        // Push job in queue
        ReplyReportPlaceEmailJob::dispatch($email);

        return true;
    }
}
