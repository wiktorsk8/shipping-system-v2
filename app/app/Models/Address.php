<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'street_number',
        'flat_number',
        'postal_code',
        'city',
        'coordinates'
    ];

    // public function convertToFullAdress(){
    //     $properties = [
    //         $this->street,
    //         $this->street_number,
    //         $this->flat_number,
    //         $this->postal_code,
    //         $this->city
    //     ];

    //     return implode(" ", $properties);
    // }

}
