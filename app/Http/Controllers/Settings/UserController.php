<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Helper;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\RoleFilter;
use App\Helpers\Enum\StatusActiveType;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
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
    $statusUserTypes = StatusActiveType::toArray();

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
    return Helper::getProfileView(isRoleName(), $user);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('settings.users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->userService->handleUpdateReviewer($request, $user->id);
    return Helper::redirectUpdateUser(isRoleId(), $user);
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

  /**
   * Return delete image in storage & database.
   */
  public function image(User $user)
  {
    if (!$user->avatar) {
      return response()->json([
        'status' => 'warning',
        'message' => trans('Anda tidak memiliki gambar untuk dihapus'),
      ]);
    } else {
      $this->userService->handleDeleteUserAvatar($user->id);
      return response()->json([
        'status' => 'success',
        'message' => trans('Berhasil menghapus gambar'),
      ]);
    }
  }
}
