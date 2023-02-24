<?php

namespace App\Services\Address;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Package;
use App\Services\GoogleApi\GoogleApiService;

class AddressService
{
    public function store(Request $request, Package $package){

        return  Address::create([
            'package_id' => $package->id,
            'street_name' => $request->street_name,
            'street_number' => $request->street_number,
            'flat_number' => $request->flat_number,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'coordinates' => GoogleApiService::addressToCoordinates($request->sender_full_address),
            'recipient_street_name' => $request->recipient_street_name,
            'recipient_street_number' => $request->recipient_street_number,
            'recipient_flat_number' => $request->recipient_flat_number,
            'recipient_postal_code' => $request->recipient_postal_code,
            'recipient_city' => $request->recipient_city,
            'recipient_coordinates' => GoogleApiService::addressToCoordinates($request->recipient_full_address)
        ]);
    }
}