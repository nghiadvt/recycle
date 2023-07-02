<?php

namespace App\Services\Admin;

use App\Models\Prefecture;
use App\Traits\ResultPaginateTrait;

class PrefectureService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param Prefecture $prefecture The Prefecture object to be assigned to the $model property.
     */
    public function __construct(Prefecture $prefecture)
    {
        $this->model = $prefecture;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get()
    {
        $prefectures = $this->model
        ->orderBy('pref_no', 'DESC')
        ->get();

        return $prefectures;
    }
}
