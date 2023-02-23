<?php

namespace App\Services\Delivery;

// Helper class for callculating delivery route

class Point{

    public $coordinates;
    public $package;
    private $max_dist = '0.59110119333249';

    public function __construct($coordinates, $package = null)
    {
        $this->coordinates = $coordinates;
        $this->package = $package;
        
    }

    public function isInArea(string $your_location): bool{
        $coordinates = explode(',', $this->coordinates);
        $location = explode(',', $your_location);

        $dist = sqrt(pow((float)$coordinates[0] - (float)$location[0], 2) + pow((float)$coordinates[1] - (float)$location[1], 2));

        if($dist <= $this->max_dist){
            return true;
        }

        return false;
    }
}