<?php

namespace App\Models;

date_default_timezone_set('CET');

use App\Events\PackageCreated;
use App\Helpers\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'status',
        'sender_email',
        'recipient_email',
    ];

    protected $casts = [
        'status' => PackageStatus::class,
    ];
    
    public function address(){
        return $this->hasOne(Address::class, 'package_id');
    }

    public function deliveries(){
        return $this->hasMany(Delivery::class, 'package_id');
    }

    public function sendersCoordinates(){  
        return explode(",", $this->address->coordinates);
    }

    public function setStatusAttributes($status){
        $this->attribute['status'] = $status;   
    }

    public function scopeSortByDate($query, $sort){
        if($sort != null){
            if($sort == 'desc'){
                $query->orderBy('created_at', 'desc');
            }else{
                $query->orderBy('created_at', 'asc');
            } 
        }
    }
    public static function generate(int $user_id, string $name)
    {    
        $attributes = [$user_id, $name];                         // convert arguments into array

        $time = str_replace(":", "", date("H:i:s"));        // sanitize date 
        $rand = rand(1000, 9999);                          

        $result = 0;                                        // converted attributes result
        foreach ($attributes as $index) {
            if (is_int($index)) {
                $result += $index;
            } else if(is_string($index)){
                for ($i = 0; $i < 3; $i++) {
                    $result += ord($index[$i]);             // convert string into ASCII code
                }
            }
        }

        $output = $rand.$result.$time;                      // merged number

        return (int)$output;
    }

}
