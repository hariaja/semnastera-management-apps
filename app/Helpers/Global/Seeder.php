<?php

namespace App\Helpers\Global;

use App\Models\User;
use App\Models\Participant;
use App\Helpers\Global\Helper;
use App\Helpers\Enum\StatusUserType;
use App\Models\Program;

class Seeder
{
  public static function createUserAndParticipant($name, $email, $phone, $gender, $institution, $address, $role)
  {
    $user = User::create([
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'email_verified_at' => now(),
      'password' => bcrypt(Helper::DEFAULT_PASSWORD),
      'status' => StatusUserType::ACTIVE->value,
    ])->assignRole($role);

    Participant::create([
      'user_id' => $user->id,
      'first_name' => explode(' ', $name)[0],
      'last_name' => explode(' ', $name)[1],
      'gender' => $gender,
      'institution' => strtoupper($institution),
      'address' => $address,
    ]);

    return $user;
  }

  public static function createProgram(string $name, string $location = null, string $responsible)
  {
    return Program::create([
      'name' => $name,
      'location' => $location,
      'responsible' => $responsible,
    ]);
  }
}
