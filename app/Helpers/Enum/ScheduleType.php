<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum ScheduleType: string
{
  use EnumsToArray;

  case UPLOAD = 'Upload Makalah';
  case SEMINAR = 'Acara Seminar';
}
