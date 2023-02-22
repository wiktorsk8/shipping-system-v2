<?php

namespace App\Models;

use App\Helpers\Package\PackageStatus;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
}
