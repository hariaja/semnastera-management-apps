<?php

namespace App\Helpers\Enum\Permissions;

use App\Traits\EnumsToArray;

enum PemakalahPermission: string
{
  use EnumsToArray;

  case USER_SHOW = 'users.show';
  case USER_PASS = 'users.password';
  case USER_IMAGE = 'users.image';
  case PARTICIPANT_UPDATE = 'paticipants.update';
}
