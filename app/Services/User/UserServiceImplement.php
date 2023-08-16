<?php

namespace App\Services\User;

use App\Helpers\Enum\StatusUserType;
use App\Helpers\Global\Helper;
use App\Repositories\Participant\ParticipantRepository;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $mainRepository,
    protected RoleRepository $roleRepository,
    protected ParticipantRepository $participantRepository,
  ) {
    // 
  }

  public function createNewParticipant($request)
  {
    return DB::transaction(function () use ($request) {
      /**
       * Jika ada avatar yang diupload maka akan digunakan sebagai avatar user
       * Jika tidak ada, maka avatar secara otomatis bernilai null
       */
      $avatar = $request->file('avatar') ? Storage::putFile(
        'public/images/' . strtolower($this->getRoleName($request->roles)),
        $request->file('avatar')
      ) : null;

      // Siapkan data yang akan di insert ke tabel users
      $validated = $request->validated();
      $validated['name'] = "{$validated['first_name']} {$validated['last_name']}";
      $validated['avatar'] = $avatar;
      $validated['password'] = $request->input('roles') ? Hash::make(Helper::DEFAULT_PASSWORD) : Hash::make($request->password);
      $validated['status'] = StatusUserType::ACTIVE->value;

      // Masukkan Data tersebut ke table users
      $user = $this->mainRepository->create($validated);
      $user->assignRole($validated['roles']);

      // Siapkan data untuk dimasukkan ke tabel participant
      $participantData = [
        'user_id' => $user->id,
        'first_title' => strtoupper($validated['first_title']),
        'last_title' => strtoupper($validated['last_title']),
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'gender' => $validated['gender'],
        'institution' => strtoupper($validated['institution']),
        'address' => $validated['address'],
      ];

      // Masukkan ke tabel participant
      $this->participantRepository->create($participantData);
      return $user;
    });
  }

  /**
   * Update Status Account User
   *
   * @param  mixed $id
   * @return void
   */
  public function updateStatusAccount($id)
  {
    return DB::transaction(function () use ($id) {
      return $this->mainRepository->updateStatusAccount($id);
    });
  }

  /**
   * Private func for get role name
   */
  protected function getRoleName(int $id): string
  {
    $role = $this->roleRepository->findOrFail($id);
    return $role->name;
  }
}
