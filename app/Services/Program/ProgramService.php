<?php

namespace App\Services\Program;

use LaravelEasyRepository\BaseService;

interface ProgramService extends BaseService
{
  public function query();
  public function getDoesntHaveSchedule();
}
