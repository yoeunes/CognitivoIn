<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class LocationPromotionType extends Enum
{
    // constants
    const GetOneByOne =            1;
    

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
