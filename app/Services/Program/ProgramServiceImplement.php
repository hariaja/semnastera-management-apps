<?php

namespace App\Services\Program;

use LaravelEasyRepository\Service;
use App\Repositories\Program\ProgramRepository;
use Illuminate\Support\Facades\DB;

class ProgramServiceImplement extends Service implements ProgramService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(ProgramRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  /**
   * Base Query
   */
  public function query()
  {
    return DB::transaction(function () {
      return $this->mainRepository->query();
    });
  }

  /**
   * Get program data that does not have schedule data or only has one.
   */
  public function getDoesntHaveSchedule()
  {
    return DB::transaction(function () {
      return $this->mainRepository->getDoesntHaveSchedule();
    });
  }
}
