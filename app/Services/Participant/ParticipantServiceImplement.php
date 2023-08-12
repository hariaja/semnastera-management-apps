<?php

namespace App\Services\Participant;

use LaravelEasyRepository\Service;
use App\Repositories\Participant\ParticipantRepository;

class ParticipantServiceImplement extends Service implements ParticipantService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ParticipantRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
