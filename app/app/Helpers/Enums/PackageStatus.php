<?php

namespace App\Helpers\Enums;

use App\Traits\EnumsToArray;

enum PackageStatus: string
{
    use EnumsToArray;

    case IN_PREPARATION = "in_preparation";
    case IN_DELIVERY = "in_delivery";
    case READY_TO_PICKUP = "ready_to_pickup";
}

