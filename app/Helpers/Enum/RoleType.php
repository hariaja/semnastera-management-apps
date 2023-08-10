<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum RoleType: string
{
  use EnumsToArray;

  case ADMIN = 'Administrator';
  case REVIEWER = 'Reviewer';
  case PEMAKALAH = 'Pemakalah';
  case PARTICIPANT = 'Peserta';
}
