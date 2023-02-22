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
        'recipients_street_name',
        'recipients_street_number',
        'recipients_flat_number',
        'recipients_postal_code',
        'recipients_city',
        'recipients_coordinates'
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
