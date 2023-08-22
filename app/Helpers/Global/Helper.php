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
   * Redirect url with message
   *
   * @param  mixed $url
   * @param  mixed $message
   * @return void
   */
  public static function redirectUrl($url, string $message)
  {
    return redirect($url)->withSuccess($message);
  }

  /**
   * Helper to Upload Files.
   *
   * @return void
   */
  public static function uploadFile(
    Request $request,
    string $filePath,
    string $currentFilePath = null
  ) {
    if ($request->file('file')) {
      if ($currentFilePath) {
        Storage::delete($currentFilePath);
      }
      return Storage::putFile("public/{$filePath}", $request->file('file'));
    } elseif ($currentFilePath) {
      return $currentFilePath;
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
   * Get condition for user home view
   */
  public static function getHomeView(string $roles, array $data)
  {
    if (
      $roles === RoleType::PEMAKALAH->value ||
      $roles === RoleType::PARTICIPANT->value
    ) {
      return view('home.user', $data);
    } else {
      return view('home.admin', $data);
    }
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

  /**
   * Change format date to indonesian date.
   *
   * @param  mixed $date
   * @param  mixed $show_day
   * @return void
   */
  public static function parseDateTime($date, bool $show_day = true)
  {
    $date_name  = array(
      'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );

    $month_name = array(
      1 =>
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $tahun = substr($date, 0, 4);
    $bulan = $month_name[(int) substr($date, 5, 2)];
    $tanggal = substr($date, 8, 2);
    $text = '';

    if ($show_day) {
      $urutan_hari = date('w', mktime(0, 0, 0, substr($date, 5, 2), $tanggal, $tahun));
      $hari = $date_name[$urutan_hari];
      $text .= "$hari, $tanggal $bulan $tahun";
    } else {
      $text .= "$tanggal $bulan $tahun";
    }

    return $text;
  }
}
