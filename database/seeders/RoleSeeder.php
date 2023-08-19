<?php

namespace Database\Seeders;

use App\Helpers\Enum\Permissions\ParticipantPermission;
use App\Models\Role;
use App\Models\Permission;
use App\Helpers\Enum\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use App\Helpers\Enum\Permissions\PemakalahPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = RoleType::toArray();

    foreach ($datas as $data) :
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    // Berikan Permission Nanti
    $pemakalah = $roles->firstWhere('name', RoleType::PEMAKALAH->value);
    $pemakalah->syncPermissions(Permission::whereIn('name', PemakalahPermission::toArray())->get());

    $participant = $roles->firstWhere('name', RoleType::PARTICIPANT->value);
    $participant->syncPermissions(Permission::whereIn('name', ParticipantPermission::toArray())->get());
  }
}
