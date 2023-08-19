<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum ProgramStatusType: string
{
  use EnumsToArray;

  case NOT_YET_STARTED = 'Belum Dimulai';
  case ONGOING = 'Sedang Berlangsung';
  case HAS_ENDED = 'Telah Berakhir';
}
