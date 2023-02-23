<?php

namespace App\Http\Services\Delivery;

use App\Http\Services\GoogleApiService;
use App\Models\Package;
use Exception;
use App\Helpers\Package\Point;
use App\Http\Requests\SetLocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeliveryManager
{
    private $available_points = [];

    private $your_location;

    public function processDelivery()
    {
        $this->your_location = User::where('id', Auth::id())->value('location');
        if ($this->your_location == null) {
            return redirect()->back()->withErrors(['msg' => 'Set your location!']);
        }

        return $this->callculateRoute();
    }

    public function setYourLocation(SetLocationRequest $request)
    {
        $location = $request->lat . ',' . $request->lng;
        User::where('id', Auth::id())->update(['location' => $location]);
        return redirect()->back();
    }

    private function callculateRoute()
    {
        $path = [];

        $this->getAllPointsInArea($this->loadPoints());

        $first_point = new Point($this->your_location);

        $current_point = $this->closestPoint($first_point, $this->available_points);
        array_push($path, $current_point);


        while (!empty($this->available_points)) {
            $current_point = $this->closestPoint($current_point, $this->available_points);
            array_push($path, $current_point);
        }

        $result = [];
        $coordinates = [];
        foreach ($path as $object) {
            array_push($result, $object->package);
            array_push($coordinates, $object->package->address->coordinates);
        }

        return view('pages.collected-packages', ['packages' => $result, 'coordinates' => $coordinates]);
    }

    private function closestPoint(Point $origin, array $points)
    {
        $smallest_distance = 100000000000000;
        $closest_point = null;

        foreach ($points as $point) {
            $dist = GoogleApiService::getDistance($origin->coordinates, $point->coordinates);
            if ($dist['distance']['value'] < $smallest_distance) {
                $smallest_distance = $dist['distance']['value'];
                $closest_point = $point;
            }
        }

        if (isset($closest_point)) {
            $key = array_search($closest_point, $this->available_points);
            unset($this->available_points[$key]);
            return $closest_point;
        } else {
            throw new Exception('point not found');
        }
    }

    private function loadPoints(): array
    {
        $packages = Package::where('status', '=', 0)->get();
        $points = [];

        foreach ($packages as $package) {
            $point = new Point($package->address->coordinates, $package);

            array_push($points, $point);
        }

        return $points;
    }

    private function getAllPointsInArea(array $points)
    {
        foreach ($points as $point) {
            if ($point->isInArea($this->your_location)) {
                array_push($this->available_points, $point);
            }
        }
    }
}
