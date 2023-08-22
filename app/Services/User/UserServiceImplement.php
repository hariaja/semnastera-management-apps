<?php

namespace App\Services\User;

use App\Helpers\Enum\StatusUserType;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Upload;
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

  public function getUserNotAdmin()
  {
    return DB::transaction(function () {
      return $this->mainRepository->getUserNotAdmin();
    });
  }

  public function getUserByRole($role)
  {
    return DB::transaction(function () use ($role) {
      return $this->mainRepository->getUserByRole($role);
    });
  }

  public function createNewParticipant($request)
  {
    return DB::transaction(function () use ($request) {
      /**
       * Jika ada avatar yang diupload maka akan digunakan sebagai avatar user
       * Jika tidak ada, maka avatar secara otomatis bernilai null
       */
      $avatar = Helper::uploadFile($request, "images/{$request->roles}", null);

      // Siapkan data yang akan di insert ke tabel users
      $validated = $request->validated();
      $validated['name'] = "{$validated['first_name']} {$validated['last_name']}";
      $validated['avatar'] = $avatar;
      $validated['password'] = $request->input('password') ? Hash::make($request->password) : Hash::make(Helper::DEFAULT_PASSWORD);
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
   * Handle create new reviewer or officer
   *
   * @param  mixed $request
   * @return void
   */
  public function createNewReviewer($request)
  {
    return DB::transaction(function () use ($request) {
      // Get role to find or get id role
      $role = $this->roleRepository->selectRoleWhereIn([$request->roles])->first();

      /**
       * Jika ada avatar yang diupload maka akan digunakan sebagai avatar user
       * Jika tidak ada, maka avatar secara otomatis bernilai null
       */
      $avatar = Helper::uploadFile($request, "images/{$this->getRoleName($role->id)}", null);

      # Save data into database
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['password'] = Hash::make(Helper::DEFAULT_PASSWORD);
      $validation['status'] = StatusUserType::ACTIVE->value;

      # Sync user to role
      $user = $this->mainRepository->create($validation);
      $user->assignRole($request->roles);
    });
  }

  /**
   * Update Existing User Data.
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return void
   */
  public function handleUpdateReviewer($request, $id)
  {
    return DB::transaction(function () use ($request, $id) {
      // Find User by Id
      $user = $this->mainRepository->findOrFail($id);

      // Handle upload avatar
      $avatar = Helper::uploadFile($request, "images/{$this->getRoleName($user->isRoleId())}", $user->avatar);

      # Handle update users
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      return $this->mainRepository->update($user->id, $validation);
    });
  }

  /**
   * Service Handle update participant in storage.
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return void
   */
  public function handleUpdateParticipant($request, $id)
  {
    return DB::transaction(function () use ($request, $id) {
      // Find Participant Data
      $participant = $this->participantRepository->findOrFail($id);

      // Find User Data
      $user = $this->mainRepository->findOrFail($participant->user_id);

      // Upload avatar
      $avatar = Helper::uploadFile($request, "images/{$this->getRoleName($user->isRoleId())}", $user->avatar);

      // Update User & Participant Data
      $validated = $request->validated();
      $validated['avatar'] = $avatar;
      $validated['name'] = "{$validated['first_name']} {$validated['last_name']}";

      $user->update($validated);
      $user->assignRole($validated['roles']);

      $data = [
        'first_title' => strtoupper($validated['first_title']),
        'last_title' => strtoupper($validated['last_title']),
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'gender' => $validated['gender'],
        'institution' => strtoupper($validated['institution']),
        'address' => $validated['address'],
      ];

      return $this->participantRepository->update($participant->id, $data);
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
   * Delete any user in database
   *
   * @param  mixed $id
   * @return void
   */
  public function handleDeleteUser(int $id)
  {
    return DB::transaction(function () use ($id) {
      $user = $this->mainRepository->findOrFail($id);
      if ($user->avatar) {
        Storage::delete($user->avatar);
      }

      return $this->mainRepository->delete($user->id);
    });
  }

  /**
   * Delete avatar from storage.
   *
   * @param  mixed $id
   * @return void
   */
  public function handleDeleteUserAvatar($id)
  {
    return DB::transaction(function () use ($id) {
      $user = $this->mainRepository->findOrFail($id);
      Storage::delete($user->avatar);
      return $this->mainRepository->handleDeleteUserAvatar($user->id);
    });
  }

  /**
   * Private func for get role name
   */
  protected function getRoleName(int $id): string
  {
    $role = $this->roleRepository->findOrFail($id);
    return "{$role->name}";
  }
}
