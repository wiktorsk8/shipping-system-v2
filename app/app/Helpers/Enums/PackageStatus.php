<?php

namespace App\Helpers\Enums;

use App\Traits\EnumsToArray;

enum PackageStatus: int
{
    use EnumsToArray;

    case IN_PREPARATION = 0;
    case IN_DELIVERY = 1;
    case DELIVERY = 2;
    case READY_TO_PICKUP = 3;
}

