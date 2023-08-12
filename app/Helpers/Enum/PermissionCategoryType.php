<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum PermissionCategoryType: string
{
  use EnumsToArray;

  case USERS = 'users.name';
  case ROLES = 'roles.name';
}
