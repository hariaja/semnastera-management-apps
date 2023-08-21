<?php

namespace App\Services\Schedule;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface ScheduleService extends BaseService
{
  public function query();
  public function createSchedule(Request $request);
}
