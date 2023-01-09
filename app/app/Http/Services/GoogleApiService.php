<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleApiService
{
    protected $base = 'https://maps.googleapis.com/maps/api/distancematrix/json?';
    protected $geolocate = 'https://www.googleapis.com/geolocation/v1/geolocate?';
    protected $geocode = 'https://maps.googleapis.com/maps/api/geocode/json';

    private $your_location = '52.406654,17.069209'; 

    public function getDistance(string $coordinates)
    {
        $params = [
            'destinations' => $coordinates,
            'origins' => $this->your_location,
            'key' => config('services.google_api.key')
        ];

        $response = Http::get($this->base, $params);

        $result = [
            'distance' => $response['rows'][0]['elements'][0]['distance'],
            'duration' => $response['rows'][0]['elements'][0]['duration']
        ];

        return $result;
    }

    public function getLocation(){
        $key = config('services.google_api.key');

        $response = Http::post($this->geolocate.'key='.$key);

        dd($response);
    }

    public function addressToCoordinates($data){

        $result = [];
        $coordinates = [];

        foreach($data as $collection){
            $arr = $collection->toArray();
            array_push($result,implode('+', $arr));
        }

        foreach($result as $value){
            $params = [
                'address' => $value,
                'key' => config('services.google_api.key')
            ];
            $response = Http::get($this->geocode, $params);
            
            $collection = collect(json_decode($response)->results[0]->geometry->location);
            array_push($coordinates, $collection->get('lat'), $collection->get('lng'));
        }

        return $coordinates;
    }
}
