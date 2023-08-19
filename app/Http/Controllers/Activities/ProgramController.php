<?php

namespace App\Http\Controllers\Activities;

use App\DataTables\Activities\ProgramDataTable;
use App\Helpers\Global\Helper;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activities\ProgramRequest;
use App\Services\Program\ProgramService;

class ProgramController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected ProgramService $programService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(ProgramDataTable $programDataTable)
  {
    return $programDataTable->render('activities.programs.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('activities.programs.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProgramRequest $request)
  {
    $this->programService->create($request->validated());
    // return redirect(route('programs.index'))->withSuccess(trans('session.create'));
    return Helper::redirectUrl(route('programs.index'), trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Program $program)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Program $program)
  {
    return view('activities.programs.edit', compact('program'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProgramRequest $request, Program $program)
  {
    $this->programService->update($program->id, $request->validated());
    return Helper::redirectUrl(route('programs.index'), trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Program $program)
  {
    $this->programService->delete($program->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
