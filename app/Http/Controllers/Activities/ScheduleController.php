<?php

namespace App\Http\Controllers\Activities;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Helpers\Global\Helper;
use App\Helpers\Enum\ScheduleType;
use App\Http\Controllers\Controller;
use App\Helpers\Enum\StatusScheduleType;
use App\Services\Program\ProgramService;
use App\Services\Schedule\ScheduleService;
use App\DataTables\Activities\ScheduleDataTable;
use App\Http\Requests\Activities\ScheduleRequest;

class ScheduleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected ProgramService $programService,
    protected ScheduleService $scheduleService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(ScheduleDataTable $scheduleDataTable)
  {
    return $scheduleDataTable->render('activities.schedules.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $scheduleTypes = ScheduleType::toArray();
    $programs = $this->programService->getDoesntHaveSchedule()->get();

    return view('activities.schedules.create', compact('scheduleTypes', 'programs'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ScheduleRequest $request)
  {
    $this->scheduleService->createSchedule($request);
    return redirect(route('schedules.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Schedule $schedule)
  {
    $schedule->end = Helper::parseDateTime($schedule->end_date);
    $schedule->start = Helper::parseDateTime($schedule->start_date);
    return response()->json($schedule);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Schedule $schedule)
  {
    $statusScheduleTypes = StatusScheduleType::toArray();
    return view('activities.schedules.edit', compact('schedule', 'statusScheduleTypes'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ScheduleRequest $request, Schedule $schedule)
  {
    $this->scheduleService->update($schedule->id, $request->all());
    return redirect(route('schedules.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Schedule $schedule)
  {
    $this->scheduleService->delete($schedule->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
