<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\Enum\GenderType;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Helper;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ParticipantRequest;
use App\Services\Participant\ParticipantService;

class ParticipantController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected UserService $userService,
    protected ParticipantService $participantService,
  ) {
    // 
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roleName = [
      RoleType::PEMAKALAH->value,
      RoleType::PARTICIPANT->value,
    ];

    $roles = $this->roleService->selectRoleWhereIn($roleName)->get();
    $genderTypes = GenderType::toArray();
    return view('settings.participants.create', compact('roles', 'genderTypes'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ParticipantRequest $request)
  {
    $this->userService->createNewParticipant($request);
    return redirect(route('users.index'))->withSuccess(trans('session.create'));
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
    $roleName = [
      RoleType::PEMAKALAH->value,
      RoleType::PARTICIPANT->value,
    ];

    $roles = $this->roleService->selectRoleWhereIn($roleName)->get();
    $genderTypes = GenderType::toArray();
    return view('settings.participants.edit', compact('participant', 'roles', 'genderTypes'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ParticipantRequest $request, Participant $participant)
  {
    $this->userService->handleUpdateParticipant($request, $participant->id);
    return Helper::redirectUpdateUser(isRoleId(), $participant->user);
  }
}
