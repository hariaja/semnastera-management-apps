<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository
{
  public function selectRoleWhereIn(array $name = []);
}
