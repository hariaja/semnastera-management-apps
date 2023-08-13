<?php

namespace App\Models;

use App\Helpers\Enum\RoleType;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelRole;

class Role extends ModelRole
{
  use HasFactory, Uuid;

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Definisikan permissions count dalam fungsi.
   *
   * @return string
   */
  public function definePermissionCount(): string
  {
    if ($this->name === RoleType::ADMIN->value) {
      return "<span class='badge text-dark'>Memiliki Semua Hak Akses</span>";
    } else {
      return "<span class='badge text-dark'>{$this->permissions->count()} Hak Akses</span>";
    }
  }
}
