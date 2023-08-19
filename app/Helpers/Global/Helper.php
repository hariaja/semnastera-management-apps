<?php

namespace App\Helpers\Global;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Helper
{
  public const ALL = 'Semua Data';
  public const DEFAULT_PASSWORD = 'password';
  public const ADMIN_CONTACT = '6285798888733';

  /**
   * Handle upload avatar.
   *
   * @return void
   */
  public static function uploadAvatar(
    Request $request,
    User $user = null,
    int $roleId = null
  ) {
    if ($request->file('avatar')) {
      if ($user && $user->avatar) {
        Storage::delete($user->avatar);
      }
      $roleName = strtolower(self::getRoleName($roleId));
      return Storage::putFile("public/images/{$roleName}", $request->file('avatar'));
    } elseif ($user) {
      return $user->avatar;
    } else {
      return null;
    }
  }

  /**
   * Get role name.
   *
   * @param  mixed $roleId
   * @return string
   */
  public static function getRoleName(int $roleId): string
  {
    $role = Role::findOrFail($roleId);
    return $role->name;
  }
}
