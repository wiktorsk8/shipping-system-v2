<?php

namespace App\Http\Services;

use App\Models\Package;
use App\Helpers\Package\PackageStatus;
use Illuminate\Support\Collection;
use App\Helpers\User\UserInfo;

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

    public static function process_request(Collection $data){

        // filtering data to get only address fields
        $filter = [
            'name',
            'size',
            'status',
            'senders_id',
            'receivers_id',
            'package_number',
            '_token'
        ];

        $receivers_address = $data->except(array_merge(UserInfo::$senders_address_fields, $filter));
        $senders_address = $data->except(array_merge(UserInfo::$receivers_address_fields, $filter));

        $service = new GoogleApiService();
        $result = $service->addressToCoordinates([$senders_address, $receivers_address]);
        
        return $result;
    }
}
