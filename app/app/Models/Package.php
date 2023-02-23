<?php

namespace App\Models;

date_default_timezone_set('CET');  

use App\Helpers\Package\PackageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_number',
        'name',
        'size',
        'status',
        'senders_address_id',
        'senders_email',
        'recipients_address_id',
        'recipients_email',
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

    public function getStatusKey(){
        return array_search($this->status, PackageStatus::PACKAGE_STATUS);  // for displaying package status as string
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
    public static function generate(int $id, string $name): int
    {    
        $attributes = [$id, $name];                         // convert arguments into array

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
