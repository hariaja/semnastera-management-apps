<?php

namespace App\Repositories\Schedule;

use LaravelEasyRepository\Repository;

interface ScheduleRepository extends Repository
{
  public function query();
  public function scheduleByProgramIdWhereType(int $programId, string $type);
}
