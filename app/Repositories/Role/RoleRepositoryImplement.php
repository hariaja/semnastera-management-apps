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
   * Mengambil data role berdasarkan nama.
   */
  public function selectRoleWhereIn(array $name = [])
  {
    return $this->model->select('*')->whereIn('name', $name)->orderBy('name', 'ASC');
  }
}
