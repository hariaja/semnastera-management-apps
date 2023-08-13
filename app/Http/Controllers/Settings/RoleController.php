<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\RoleRequest;
use App\Models\Role;
use App\Services\PermissionCategory\PermissionCategoryService;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected PermissionCategoryService $permissionCategoryService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RoleDataTable $roleDataTable)
  {
    return $roleDataTable->render('settings.roles.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $permissions = $this->permissionCategoryService->with(['permissions'])->get();
    return view('settings.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoleRequest $request)
  {
    $this->roleService->storeNewRole($request);
    return redirect(route('roles.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Role $role)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoleRequest $request, Role $role)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    $this->roleService->delete($role->id);
    return response()->json([
      'message' => trans('session.delete'),
    ], 200);
  }
}
