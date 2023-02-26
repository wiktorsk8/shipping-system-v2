<?php

namespace App\Services\Package;

use App\DataTransferObjects\Package\StorePackageDTO;
use App\Models\Package;


class PackageService
{

    public function store(StorePackageDTO $data): Package{
        return Package::create([
            'package_number' => $data->package_number,
            'name' => $data->name,
            'status' => $data->status,
            'size' => $data->size,
            'recipient_email' => $data->recipient_email,
            'sender_email' => $data->sender_email,
        ]);
    }

    // public static function readyToSend(){
    //     return Package::where('status', '=', (string)PackageStatus::IN_PREPARATION)->get();
    // }
}