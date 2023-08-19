<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
      // Halaman Users
      'users.index', 'users.create', 'users.store', 'users.show',
      'users.password', 'users.status', 'users.edit', 'users.update', 'users.destroy',
      'users.image',

      // Halaman Role
      'roles.index', 'roles.create', 'roles.store',
      'roles.edit', 'roles.update', 'roles.destroy',

      // Participants
      'participants.create',
      'participants.store',
      'participants.edit',
      'participants.update',

      // Programs
      'programs.index', 'programs.create', 'programs.store', 'programs.show',
      'programs.edit', 'programs.update', 'programs.destroy',
    ];

    $guardName = 'web';
    $permissionCategoryId = [
      'users' => 1,
      'roles' => 2,
      'participants' => 3,
      'programs' => 4,
    ];

    foreach ($permissions as $permission) :
      Permission::firstOrCreate([
        'name' => $permission,
        'permission_category_id' => $permissionCategoryId[explode('.', $permission)[0]],
        'guard_name' => $guardName,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    endforeach;
  }
}
