<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum as BaseEnum;

abstract class Enum extends BaseEnum
{
    public static function labels()
    {
        return static::constants()
        ->flip()
        ->map(function ($key) {
            // Place your translation strings in `resources/lang/en/enum.php`
            return trans(sprintf('enum.%s', strtolower($key)));
        })
        ->all();
    }
}
