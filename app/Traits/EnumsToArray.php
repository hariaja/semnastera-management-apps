<?php

namespace App\Traits;

trait EnumsToArray
{
  public static function toArray()
  {
    return array_map(
      fn (self $enum) => $enum->value,
      self::cases()
    );
  }

  public static function toValidation()
  {
    return 'in:' . implode(',', array_map(
      fn (self $enum) => $enum->value,
      self::cases()
    ));
  }
}
