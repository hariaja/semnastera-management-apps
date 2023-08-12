<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Helper;
use Illuminate\Database\Seeder;
use App\Helpers\Enum\StatusUserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // User Admin
    User::create([
      'name' => RoleType::ADMIN->value,
      'email' => 'admin@gmail.com',
      'phone' => '085798888733',
      'email_verified_at' => now(),
      'password' => bcrypt(Helper::DEFAULT_PASSWORD),
      'status' => StatusUserType::ACTIVE->value,
    ])->assignRole(RoleType::ADMIN->value);
  }
}
