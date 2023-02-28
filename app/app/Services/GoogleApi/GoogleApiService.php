<?php

namespace App\Services\GoogleApi;

use Illuminate\Support\Facades\Http;
use App\DataTransferObjects\Api\Google\GoogleAddressDTO;

class GoogleApiService
{

    public static function getDistance(string $origins, $destination)
    {
        $params = [
            'destinations' => $destination,
            'origins' => $origins,
            'key' => config('services.google_api.key')
        ];

        $response = Http::get(config('services.google_api.distance'), $params);

        $result = [
            'distance' => $response['rows'][0]['elements'][0]['distance'],
            'duration' => $response['rows'][0]['elements'][0]['duration']
        ];

        return $result;
    }

    public static function getLocation()
    {
        $key = config('services.google_api.key');

        $response = Http::post(config('services.google_api.geolocate') . 'key=' . $key);
    }

    public static function addressToCoordinates(GoogleAddressDTO $data)
    {
        $response = self::geocodeCall($data);

        $collection = collect(json_decode($response)->results[0]->geometry->location);

        return $collection->get('lat') . ',' . $collection->get('lng');
    }

    public static function geocodeCall(GoogleAddressDTO $data){

        $result = self::convertAddress($data);

        $params = [
            'address' => $result,
            'key' => config('services.google_api.key')
        ];

        return  Http::get(config('services.google_api.geocode'), $params);
    }

    private static function convertAddress(GoogleAddressDTO $data){
        return $data->street_name.'+'.$data->street_number.'+'.$data->postal_code.'+'.$data->city;
    }
}
