<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function getUserNotAdmin();
  public function getUserByRole(string $roles);
  public function updateStatusAccount(int $id);
  public function createNewReviewer(Request $request);
  public function createNewParticipant(Request $request);
  public function handleUpdateReviewer(Request $request, int $id);
  public function handleUpdateParticipant(Request $request, int $id);
  public function handleDeleteUser(int $id);
  public function handleDeleteUserAvatar(int $id);
}
