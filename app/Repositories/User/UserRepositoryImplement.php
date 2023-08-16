<?php

namespace App\Repositories\User;

use App\Helpers\Enum\StatusUserType;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

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
    $newStatus = ($user->status == StatusUserType::ACTIVE->value) ? StatusUserType::INACTIVE->value : StatusUserType::ACTIVE->value;
    $user->updateOrFail([
      'status' => $newStatus,
    ]);

    return $user;
  }
}
