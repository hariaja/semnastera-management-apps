<?php

namespace App\Repositories\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository
{
  public function query();
  public function selectRoleWhereIn(array $name = []);
  public function roleHasPermissions(int $id);
  public function storeNewRole(Request $request);
  public function updateExistingRole(int $id, Request $request);
}
