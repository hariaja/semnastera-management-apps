<?php

namespace App\Services\Schedule;

use LaravelEasyRepository\Service;
use App\Repositories\Schedule\ScheduleRepository;

class ScheduleServiceImplement extends Service implements ScheduleService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ScheduleRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
