<?php

namespace App\Helpers\Enums;

enum UserRole: int{
    case Admin = 0;
    case Client = 1;
    case Courier = 2;
}