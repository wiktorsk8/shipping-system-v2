<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

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

        dd($response);
    }

    public static function addressToCoordinates(string $data)
    {
        $result = str_replace(" ", "+", $data);

        $params = [
            'address' => $result,
            'key' => config('services.google_api.key')
        ];

        $response = Http::get(config('services.google_api.geocode'), $params);

        $collection = collect(json_decode($response)->results[0]->geometry->location);

        $coordinates = $collection->get('lat') . ',' . $collection->get('lng');

        return $coordinates;
    }
}
