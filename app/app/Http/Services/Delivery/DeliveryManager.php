<?php

namespace App\Http\Services\Delivery;

use App\Http\Services\GoogleApiService;

class DeliveryManager
{
    public function deliveryProcess()
    {
        $service = new GoogleApiService();
        $points = $service->getAllPointsInArea();

        $this->callculateRoute($points, $service);
    }

    private function callculateRoute($points, GoogleApiService $service)
    {
        $this->starterPoint($points, $service);
    }

    private function starterPoint($points, GoogleApiService $service)
    {
        $smallest_distance = 100000000000000;
        $first_point = null;

        foreach ($points as $point) {
            $current_distance = $service->getDistance($service->your_location, $point->getSendersCoordinates());
            if ($current_distance['distance']['value'] < $smallest_distance) {
                $first_point = $point;
            }
        }

        return $first_point;
    }
}
