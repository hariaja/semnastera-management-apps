<?php

namespace App\Helpers\Global;

use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RoleType;
use App\Models\Participant;
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
   * Handle delete user avatar
   *
   * @param  mixed $user
   * @return void
   */
  public static function deleteAvatar(User $user)
  {
    if ($user->avatar)
      return Storage::delete($user->avatar);

    return false;
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

  /**
   * Get condition for user profile view
   *
   * @param  mixed $roles
   * @param  mixed $user
   * @return void
   */
  public static function getProfileView($roles, User $user)
  {
    if (
      $roles === RoleType::PEMAKALAH->value ||
      $roles === RoleType::PARTICIPANT->value
    ) {
      $genderTypes = GenderType::toArray();
      $participant = Participant::firstWhere('user_id', $user->id);
      return view('settings.participants.show', compact('user', 'genderTypes', 'participant'));
    } else {
      return view('settings.users.show', compact('user'));
    }
  }

  /**
   * Handle redirect page after update data user.
   *
   * @param  mixed $roleId
   * @param  mixed $user
   * @return void
   */
  public static function redirectUpdateUser($roleId, User $user)
  {
    if ($roleId == $user->isRoleId()) {
      return redirect(route('users.show', $user->uuid))->withSuccess(trans('session.update'));
    } else {
      return redirect(route('users.index'))->withSuccess(trans('session.update'));
    }
  }
}
