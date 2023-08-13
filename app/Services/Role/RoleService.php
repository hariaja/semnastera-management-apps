<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface RoleService extends BaseService
{
  public function baseQuery();
  public function selectRoleWhereIn(array $name = []);
  public function storeNewRole(Request $request);
}
