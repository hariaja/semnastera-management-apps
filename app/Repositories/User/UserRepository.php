<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function query();
  public function getQueryWhereHas(string $relation, string $column, $condition);
  public function updateStatusAccount(int $id);
}
