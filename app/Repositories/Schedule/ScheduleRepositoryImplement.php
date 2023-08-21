<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use App\Helpers\Global\Helper;
use App\Helpers\Enum\ScheduleType;
use LaravelEasyRepository\Implementations\Eloquent;

class ScheduleRepositoryImplement extends Eloquent implements ScheduleRepository
{
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

  /**
   * Base query
   */
  public function query()
  {
    return $this->model->newQuery();
  }

  public function scheduleByProgramIdWhereType($programId, $type)
  {
    return $this->model->where('program_id', $programId)
      ->where('type', $type)
      ->exists();
  }
}
