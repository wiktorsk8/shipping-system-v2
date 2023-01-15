<?php

namespace App\Models;

use App\Helpers\Package\PackageStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'status',
        'senders_address',
        'senders_email',
        'reipient_address',
        'recipient_email',
    ];

    

    public function sendersAddress(){
        return $this->hasOne(Address::class, 'senders_address');
    }

    public function recipientsAddress(){
        return $this->hasOne(Address::class, 'recipients_address');
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
