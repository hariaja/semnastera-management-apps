<?php

namespace App\Repositories\Program;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Program;

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
}
