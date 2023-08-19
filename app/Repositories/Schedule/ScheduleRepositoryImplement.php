<?php

namespace App\Repositories\Schedule;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Schedule;

class ScheduleRepositoryImplement extends Eloquent implements ScheduleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
