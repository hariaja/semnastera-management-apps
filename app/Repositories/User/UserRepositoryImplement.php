<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Helpers\Enum\StatusActiveType;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  /**
   * Base query
   */
  public function query()
  {
    return $this->model->query();
  }

  /**
   * Get All User Where Role Not Admin
   *
   * @return void
   */
  public function getUserNotAdmin()
  {
    return $this->query()->select('*')->whereNotAdmin();
  }

  /**
   * Get User by Role Name
   *
   * @param  mixed $role
   * @return void
   */
  public function getUserByRole($role)
  {
    return $this->query()->select('*')->whereHas('roles', function ($row) use ($role) {
      $row->where('name', $role);
    })->active();
  }

  /**
   * Get All User Where Has :relation :column :condition
   *
   * @return void
   */
  public function getQueryWhereHas($relation, $column, $condition)
  {
    return $this->query()->select('*')->whereHas($relation, function ($row) use ($column, $condition) {
      $row->where($column, $condition);
    });
  }

  /**
   * Update Status Account User
   *
   * @param  mixed $id
   * @return void
   */
  public function updateStatusAccount($id)
  {
    $user = $this->findOrFail($id);
    $newStatus = ($user->status == StatusActiveType::ACTIVE->value) ? StatusActiveType::INACTIVE->value : StatusActiveType::ACTIVE->value;
    $user->updateOrFail([
      'status' => $newStatus,
    ]);

    return $user;
  }

  /**
   * Delete user avatar in local storage & make field null
   *
   * @param  mixed $id
   * @return void
   */
  public function handleDeleteUserAvatar($id)
  {
    $user = $this->findOrFail($id);
    return $user->updateOrFail([
      'avatar' => NULL,
    ]);
  }
}
