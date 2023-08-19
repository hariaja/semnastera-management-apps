<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum PermissionCategoryType: string
{
  use EnumsToArray;

  case USERS = 'users.name';
  case ROLES = 'roles.name';
  case USER_CATEGORIES = 'participants.name';
  case PROGRAMS = 'programs.name';
  case SCHEDULES = 'schedules.name';
}
