<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class ItemPromotionType extends Enum
{
    // constants
    const GetOneByOne =            1;
    const GetOneBytwo =            2;

    public static function labels()
    {
        return static::constants()
        ->flip()
        ->map(function ($key) {
            // Place your translation strings in `resources/lang/en/enum.php`
            return trans(sprintf('%s', strtolower($key)));
        })
        ->all();
    }
}
