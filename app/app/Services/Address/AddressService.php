<?php

namespace App\Services\Address;

use App\DataTransferObjects\Address\StoreAddressDTO;
use App\DataTransferObjects\Api\Google\GoogleAddressDTO;
use App\Models\Address;
use App\Models\Package;
use App\Services\GoogleApi\GoogleApiService;

class AddressService
{
    public function store(StoreAddressDTO $addressData, Package $package){

        $sender_address = new GoogleAddressDTO($addressData->street_name,
            $addressData->street_number,
            $addressData->postal_code,
            $addressData->city);
            $sender_coordinates = GoogleApiService::addressToCoordinates($sender_address);

        $recipient_address = new GoogleAddressDTO($addressData->recipient_street_name,
            $addressData->recipient_street_number,
            $addressData->recipient_postal_code,
            $addressData->recipient_city);
            $recipient_coordinates = GoogleApiService::addressToCoordinates($recipient_address);
    
        
        return  Address::create([
            'package_id' => $package->id,
            'street_name' => $addressData->street_name,
            'street_number' => $addressData->street_number,
            'flat_number' => $addressData->flat_number,
            'postal_code' => $addressData->postal_code,
            'city' => $addressData->city,
            'coordinates' => $sender_coordinates,
            
            'recipient_street_name' => $addressData->recipient_street_name,
            'recipient_street_number' => $addressData->recipient_street_number,
            'recipient_flat_number' => $addressData->recipient_flat_number,
            'recipient_postal_code' => $addressData->recipient_postal_code,
            'recipient_city' => $addressData->recipient_city,
            'recipient_coordinates' => $recipient_coordinates
        ]);
    }
}