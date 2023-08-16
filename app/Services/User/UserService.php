<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function updateStatusAccount(int $id);
  public function createNewParticipant(Request $request);
}
