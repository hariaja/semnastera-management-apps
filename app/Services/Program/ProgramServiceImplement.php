<?php

namespace App\Services\Program;

use LaravelEasyRepository\Service;
use App\Repositories\Program\ProgramRepository;

class ProgramServiceImplement extends Service implements ProgramService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProgramRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
