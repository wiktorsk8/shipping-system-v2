<?php

namespace App\Http\Services\Delivery;

use App\Http\Services\GoogleApiService;

class DeliveryManager
{
    public function callculateRoute()
    {

        $service = new GoogleApiService();
        $points = $service->getAllPointsInArea();
       // dd($points);

        $first_point = $this->closestPoint($service->your_location, $points, $service); 

        $order = $this->recu($first_point, $points, [],  $service);

        dump($order);

    }

    private function closestPoint($B, array $points, GoogleApiService $service)
    {
        $smallest_distance = 100000000000000;
        $first_point = null;

        foreach ($points as $point) {
            if ($B != $point->getSendersCoordinates()) {
                $current_distance = $service->getDistance($B, $point->getSendersCoordinates());
                if ($current_distance['distance']['value'] < $smallest_distance) 
                {
                    $first_point = $point;
                }
            }
        }


        return $first_point;
    }

    private function recu($x, array $points, array $order, GoogleApiService $service){
        if (empty($points)){
            
            return $order;
        }
        $closest_point = $this->closestPoint($x, $points, $service);

        $key = array_search($closest_point, $points);
        unset($points[$key]);

        array_push($order, $closest_point);


        return $this->recu($closest_point, $points, $order,  $service);
    }



}
