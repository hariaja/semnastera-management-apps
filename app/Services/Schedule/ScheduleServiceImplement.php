<?php

namespace App\Services\Schedule;

use Illuminate\Http\Request;
use App\Helpers\Global\Helper;
use App\Helpers\Enum\ScheduleType;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\Program\ProgramRepository;
use App\Repositories\Schedule\ScheduleRepository;

class ScheduleServiceImplement extends Service implements ScheduleService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected ScheduleRepository $mainRepository,
    protected ProgramRepository $programRepository,
  ) {
    // 
  }

  /**
   * Base query builder
   *
   */
  public function query()
  {
    return DB::transaction(function () {
      return $this->mainRepository->query();
    });
  }

  /**
   * Handle create schedule and create validation of schedule where have 1 type schedule.
   */
  public function createSchedule($request)
  {
    return DB::transaction(function () use ($request) {
      $programId = $request->input('program_id');
      $program = $this->programRepository->findOrFail($programId);

      $hasUploadSchedule = $program->schedules()->where('type', ScheduleType::UPLOAD->value)->count();

      if ($hasUploadSchedule > 0 && $request->type === ScheduleType::UPLOAD->value) {
        return redirect(route('schedules.index'))->with('error', "Tidak dapat menambahkan jadwal pada acara {$program->name} karena kategori '" . ScheduleType::UPLOAD->value . "' sudah tersedia. Silahkan pilih kategori yang lainnya!");
      }

      return $this->mainRepository->create($request->validated());
    });
  }
}
