<?php

namespace Modules\CustomerAd\Actions;

use Modules\CustomerAd\Entities\Ad;

class CreateAd
{
    public static function create($request)
    {
        return Ad::create($request);
    }
}
