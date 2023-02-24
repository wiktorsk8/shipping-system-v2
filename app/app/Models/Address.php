<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'street_name',
        'street_number',
        'flat_number',
        'postal_code',
        'city',
        'coordinates',
        'recipient_street_name',
        'recipient_street_number',
        'recipient_flat_number',
        'recipient_postal_code',
        'recipient_city',
        'recipient_coordinates'
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
