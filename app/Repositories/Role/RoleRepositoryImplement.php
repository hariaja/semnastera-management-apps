<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Role;

class RoleRepositoryImplement extends Eloquent implements RoleRepository
{

  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Role $model)
  {
    $this->model = $model;
  }

  /**
   * Get All Data Roles
   *
   * @return void
   */
  public function baseQuery()
  {
    return $this->model->query();
  }

  /**
   * Mengambil data role berdasarkan nama.
   */
  public function selectRoleWhereIn(array $name = [])
  {
    return $this->model->select('*')->whereIn('name', $name)->orderBy('name', 'ASC');
  }

  public function storeNewRole($request)
  {
    return $this->model->firstOrCreate([
      'name' => $request->name,
    ])->syncPermissions($request->permission);
  }
}
