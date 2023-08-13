<?php

namespace App\Repositories\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository
{
  public function baseQuery();
  public function selectRoleWhereIn(array $name = []);
  public function storeNewRole(Request $request);
}
