<?php

namespace App\Repositories\Program;

use App\Helpers\Enum\ScheduleType;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use LaravelEasyRepository\Implementations\Eloquent;

class ProgramRepositoryImplement extends Eloquent implements ProgramRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Program $model)
  {
    $this->model = $model;
  }

  /**
   * Base query
   */
  public function query()
  {
    return $this->model->query();
  }

  /**
   * Get program data that does not have schedule data or only has one.
   */
  public function getDoesntHaveSchedule()
  {
    return $this->model->where(function (Builder $query) {
      $query->whereDoesntHave('schedules', function ($subQuery) {
        $subQuery->whereIn('type', ScheduleType::toArray());
      })->orWhere(function ($subQuery) {
        $subQuery->whereHas('schedules', function ($subSubQuery) {
          $subSubQuery->whereIn('type', ScheduleType::toArray(0));
        })->whereDoesntHave('schedules', function ($subSubQuery) {
          $subSubQuery->whereIn('type', ScheduleType::toArray(1));
        });
      })->orWhere(function ($subQuery) {
        $subQuery->whereHas('schedules', function ($subSubQuery) {
          $subSubQuery->whereIn('type', ScheduleType::toArray(1));
        })->whereDoesntHave('schedules', function ($subSubQuery) {
          $subSubQuery->whereIn('type', ScheduleType::toArray(0));
        });
      });
    });
  }
}
