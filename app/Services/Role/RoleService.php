<?php

namespace App\Services\Role;

use LaravelEasyRepository\BaseService;

interface RoleService extends BaseService
{
  public function selectRoleWhereIn(array $name = []);
}
