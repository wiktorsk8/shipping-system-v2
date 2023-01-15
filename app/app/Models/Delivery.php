<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'couriers_id'
    ];

    public function courier(){
        return $this->hasOne(User::class, 'couriers_id');
    }

    public function package(){
        return $this->hasOne(Package::class, 'package_id');
    }

}
