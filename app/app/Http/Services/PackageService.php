<?php

namespace App\Http\Services;

use App\Models\Package;
use App\Helpers\Package\PackageStatus;
use Illuminate\Support\Collection;
use App\Models\User;

class PackageService
{
    // Helper class for extra logic

    public static function pushStatus(Package $package)
    {
        $status = $package->getStatus();

        switch ($status) {
            case PackageStatus::PACKAGE_STATUS['In preparaion']:
                $package->setStatus(PackageStatus::PACKAGE_STATUS['In delivery']);
                break;
            case  PackageStatus::PACKAGE_STATUS['In delivery']:
                $package->setStatus(PackageStatus::PACKAGE_STATUS['Delivered']);
                break;
            case  PackageStatus::PACKAGE_STATUS['Delivered']:
                $package->setStatus(PackageStatus::PACKAGE_STATUS['Ready to pickup']);
                break;
            default:
                $package->setStatus(PackageStatus::PACKAGE_STATUS['In preparation']);
                break;
        }
    }

    public static function readyToSend(){
        return Package::where('status', '=', (string)PackageStatus::PACKAGE_STATUS['In preparation'])->get();
    }
}
