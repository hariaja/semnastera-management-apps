<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Scopes\RoleFilter;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
use App\Helpers\Enum\RoleType;
use App\Helpers\Enum\StatusUserType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UserRequest;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    $roleTypes = RoleType::toArray();
    $statusUserTypes = StatusUserType::toArray();

    return $dataTable
      ->addScope(new RoleFilter($request))
      ->addScope(new StatusFilter($request))
      ->render('settings.users.index', compact(
        'roleTypes',
        'statusUserTypes'
      ));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->selectRoleWhereIn([
      RoleType::REVIEWER->value
    ])->first();

    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userService->createNewReviewer($request);
    return redirect(route('users.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->handleDeleteUser($user->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  /**
   * Update the specified status account user.
   */
  public function status(User $user)
  {
    $this->userService->updateStatusAccount($user->id);
    return response()->json([
      'message' => trans('session.status'),
    ]);
  }
}
