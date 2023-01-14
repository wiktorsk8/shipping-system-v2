<?php

namespace App\Http\Services\Delivery;

use App\Models\Package;

class Point{

    public $coordinates;

    private $max_dist = '0.25110119333249';

    public function __construct($coordinates)
    {
        $this->coordinates = $coordinates;
        
    }

    public function isInArea(string $your_location): bool{
        $coordinates = explode(',', $this->coordinates);
        $location = explode(',', $your_location);


        $dist = sqrt(pow((int)$coordinates[0] - (int)$location[0], 2) + pow((int)$coordinates[1] - (int)$location[1], 2));

        if($dist <= $this->max_dist){
            return true;
        }

        return false;
    }

    
}