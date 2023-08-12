<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum GenderType: string
{
  use EnumsToArray;

  case MALE = 'Laki - Laki';
  case FEMALE = 'Perempuan';
}
