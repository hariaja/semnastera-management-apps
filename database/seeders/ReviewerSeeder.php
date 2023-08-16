<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Enum\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    for ($i = 1; $i <= 5; $i++) :
      $reviewers = User::factory()->create();
      $reviewers->assignRole(RoleType::REVIEWER->value);
    endfor;
  }
}
