<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PermissionCategorySeeder::class,
      PermissionSeeder::class,
      RoleSeeder::class,
      AdminSeeder::class,
      ReviewerSeeder::class,
      ParticipantSeeder::class,
      ProgramSeeder::class,
      ScheduleSeeder::class,
      BankSeeder::class,
    ]);
  }
}
