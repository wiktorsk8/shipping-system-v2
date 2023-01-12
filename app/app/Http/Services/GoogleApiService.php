<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Package;
use Exception;

class GoogleApiService
{
    protected $base = 'https://maps.googleapis.com/maps/api/distancematrix/json?';
    protected $geolocate = 'https://www.googleapis.com/geolocation/v1/geolocate?';
    protected $geocode = 'https://maps.googleapis.com/maps/api/geocode/json';

    public $your_location = '52.406654,17.069209'; 

    protected $max_distance = '0.21241491324293';

    public function getDistance(string $origins, $destination)
    {
        $params = [
            'destinations' => $destination,
            'origins' => $origins,
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

    private function isInArea(string $coordinates){
        if(empty($coordinates)){
            return false;
        }

        $coordinates = explode(',', $coordinates);
        $location = explode(',', $this->your_location);


        $dist = sqrt(pow((int)$coordinates[0] - (int)$location[0], 2) + pow((int)$coordinates[1] - (int)$location[1], 2));

        if($dist <= $this->max_distance){
            return true;
        }

        return false;
    }

    public function getAllPointsInArea(){

        $packages = Package::all();

        $data = [];

        foreach($packages as $package){
            if($this->isInArea($package->senders_coordinates)){
                array_push($data, $package);
            }
        }

        return $data;

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
