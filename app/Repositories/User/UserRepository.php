<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function query();
  public function getUserNotAdmin();
  public function getUserByRole(string $role);
  public function getQueryWhereHas(string $relation, string $column, $condition);
  public function updateStatusAccount(int $id);
  public function handleDeleteUserAvatar(int $id);
}
