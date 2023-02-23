<?php

namespace App\Services\Package;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Helpers\Enums\PackageStatus;

class PackageService
{
    public function store(Request $request){
        return Package::create([
            'package_number' => $request->package_number,
            'name' => $request->name,
            'status' => $request->status,
            'size' => $request->size,
            'recipients_email' => $request->recipients_email,
            'senders_email' => $request->senders_email,
        ]);
    }

    public static function pushStatus(Package $package)
    {
        $status = $package->getStatus();

        // switch ($status) {
        //     case PackageStatus::PACKAGE_STATUS['In preparaion']:
        //         $package->setStatus(PackageStatus::PACKAGE_STATUS['In delivery']);
        //         break;
        //     case  PackageStatus::PACKAGE_STATUS['In delivery']:
        //         $package->setStatus(PackageStatus::PACKAGE_STATUS['Delivered']);
        //         break;
        //     case  PackageStatus::PACKAGE_STATUS['Delivered']:
        //         $package->setStatus(PackageStatus::PACKAGE_STATUS['Ready to pickup']);
        //         break;
        //     default:
        //         $package->setStatus(PackageStatus::PACKAGE_STATUS['In preparation']);
        //         break;
        // }
    }

    public static function readyToSend(){
        return Package::where('status', '=', (string)PackageStatus::IN_PREPARATION)->get();
    }
}