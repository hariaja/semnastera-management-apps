<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use App\Helpers\Enum\PermissionCategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = PermissionCategoryType::toArray();

    foreach ($items as $name) :
      PermissionCategory::firstOrCreate([
        'name' => $name,
      ]);
    endforeach;
  }
}
