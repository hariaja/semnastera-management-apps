<?php

namespace App\Helpers\Global;

class GenerateName
{
  public static function shortName($data)
  {
    $nameParts = explode(" ", $data);
    $nameCount = count($nameParts);
    $shortName = '';

    foreach ($nameParts as $index => $namePart) {
      if ($index === 0 || $index === $nameCount - 1) {
        $shortName .= $namePart . ' ';
      } else {
        $shortName .= substr($namePart, 0, 1) . ' ';
      }
    }

    return rtrim($shortName);
  }
}
