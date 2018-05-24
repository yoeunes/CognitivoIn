<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

class ActivityTypesEnum extends Enum
{
    // constants
    const Task =            1;
    const PhoneCall =       2;
    const VideoConf =       3;
    const Meeting =         4;
    const Visit =           5;
    const Email =           6;

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
