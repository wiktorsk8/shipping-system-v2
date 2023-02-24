<?php

namespace App\Services\Package;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Helpers\Enums\PackageStatus;
use App\Services\Address\AddressService;
use App\Services\GoogleApi\GoogleApiService;

class PackageService
{

    public function store(Request $request){

        GoogleApiService::testGeocodeResponse($request->full_sender_address);
        GoogleApiService::testGeocodeResponse($request->full_recipient_address);

        return Package::create([
            'package_number' => $request->package_number,
            'name' => $request->name,
            'status' => $request->status,
            'size' => $request->size,
            'recipient_email' => $request->recipient_email,
            'sender_email' => $request->sender_email,
        ]);
    }

    public static function readyToSend(){
        return Package::where('status', '=', (string)PackageStatus::IN_PREPARATION)->get();
    }
}