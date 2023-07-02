<?php

namespace App\Services\Admin;

use App\Models\Schedule;
use App\Traits\ResultPaginateTrait;
use Illuminate\Support\Facades\DB;
use App\Models\GarbageTypeSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Filters\ScheduleFilter;

class ScheduleService
{
    use ResultPaginateTrait;

    protected $model;

    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    /**
     * Get all ScheduleDay records
     *
     * @param array $columns
     * @param int $limit
     *
     * @return array
     */
    public function getSchedules($limit, $columns = [], Request $request = new Request())
    {
        $defaultColumns = Schedule::COLUMNS;
        $scheduleFilter = new ScheduleFilter($request);

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);
        $schedules = $this->model
            ->select($selectedColumns ?: $defaultColumns)
            ->withGarbageType()
            ->filter($scheduleFilter)
            ->paginate($limit)
            ->toArray();

        // Loop through each result and format the time_start_at, time_end_at
        foreach ($schedules['data'] as &$schedule) {
            $schedule['time_start_at'] = Carbon::parse($schedule['time_start_at'])->format('H:i');
            $schedule['time_end_at'] = Carbon::parse($schedule['time_end_at'])->format('H:i');
        }

        return $this->resultCustomizePaginate($schedules);
    }

    /**
     * Add a record in GarbageTypeScheduleScheduleDays
     *
     * @param array $data
     * @param int $scheduleID
     * @return mixed
     */
    public function storeGarbageTypeSchedules($data, $scheduleID)
    {
        // Reset array garbage_type
        $newDataGabageType = array_values($data['garbage_type']);

        for ($i = 0; $i < count($newDataGabageType); $i++) {
            GarbageTypeSchedule::create(
                [
                    'schedule_id' => $scheduleID,
                    'garbage_type_id' => $newDataGabageType[$i],
                ]
            );
        }
    }

    /**
     * Method addSchedule
     *
     * @param $data $data [explicite description]
     *
     * @return array
     */
    public function addSchedule($data)
    {
        try {
            DB::beginTransaction();
            $schedule = $this->model->create($data);
            $scheduleID = $schedule->id;
            $this->storeGarbageTypeSchedules($data, $scheduleID);
            DB::commit();

            return $this->getSchedules(config('define.paginate.default'));
        } catch (Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }

    /**
     * Update a schedule with id
     *
     * @param array $data
     * @param int $id
     *
     * @return mixed
     */
    public function updateSchedule($data, $id)
    {
        try {
            DB::beginTransaction();
            $schedule =  $this->model->find($id);
            if ($schedule) {
                $schedule->update($data);
                GarbageTypeSchedule::where('schedule_id', $schedule->id)->delete();
                $this->storeGarbageTypeSchedules($data, $schedule->id);
                DB::commit();

                return $this->getSchedules(config('define.paginate.default'));
            }
            return false;
        } catch (Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }
}
