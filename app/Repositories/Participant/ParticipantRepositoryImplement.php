<?php

namespace App\Repositories\Participant;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Participant;

class ParticipantRepositoryImplement extends Eloquent implements ParticipantRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Participant $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
