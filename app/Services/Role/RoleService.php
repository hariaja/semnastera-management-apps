<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface RoleService extends BaseService
{
  public function query();
  public function roleHasPermissions(int $id);
  public function selectRoleWhereIn(array $name = []);
  public function storeNewRole(Request $request);
  public function updateExistingRole(int $id, Request $request);
}
