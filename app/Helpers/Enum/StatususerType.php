<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum StatusUserType: int
{
  use EnumsToArray;

  case ACTIVE = 1;
  case INACTIVE = 0;
}
