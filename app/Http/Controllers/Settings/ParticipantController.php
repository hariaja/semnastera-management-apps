<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Services\Participant\ParticipantService;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    // protected UserService $userService,
    protected ParticipantService $participantService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Participant $participant)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Participant $participant)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Participant $participant)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Participant $participant)
  {
    //
  }
}
