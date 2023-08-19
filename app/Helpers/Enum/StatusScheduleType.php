<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum StatusScheduleType: string
{
  use EnumsToArray;

  case OPEN = 'Dibuka';
  case CLOSE = 'Ditutup';
}
