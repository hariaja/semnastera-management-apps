<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Get current user login.
 *
 * @return Authenticatable
 */
function me(): Authenticatable
{
  return Auth::user();
}

/**
 * Get role id by user login.
 *
 * @return int
 */
function isRoleId(): int
{
  return me()->roles->implode('id');
}

/**
 * Get role name by user login.
 *
 * @return string
 */
function isRoleName(): string
{
  return me()->roles->implode('name');
}

/**
 * Check Single Permissions
 *
 * @param  mixed $permission
 * @return void
 */
function checkPermission(string $permission)
{
  return me()->can($permission);
}

function checkPermissions(array $permissions = [])
{
  return me()->canany($permissions);
}
