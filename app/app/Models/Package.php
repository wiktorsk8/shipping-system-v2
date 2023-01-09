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
        'senders_address',
        'receivers_address',
        'size',
        'cash_on_delivery',
        'receivers_id',
        'senders_id',
        'status'
    ];

    protected $with = [
        'receiver',
        'sender'
    ];



    public function sender(){
        return $this->belongsTo(User::class, 'senders_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receivers_id');
    }

    public function getStatus(){
        return $this->status;
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
