<?php

namespace App\Repositories\Program;

use LaravelEasyRepository\Repository;

interface ProgramRepository extends Repository
{
  public function query();
}
