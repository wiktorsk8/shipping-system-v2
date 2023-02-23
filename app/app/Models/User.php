<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $senders_address_fields = [
        'city',
        'postal_code',
        'street_name',
        'street_number',
        'flat_number'
    ];

    public static $receivers_address_fields = [
        'receivers_city',
        'receivers_postal_code',
        'receivers_street_name',
        'receivers_street_number',
        'receivers_flat_number'
    ];


    public function sent()
    {
        return $this->hasMany(Package::class, 'senders_email');
    }


    public function receiving()
    {
        return $this->hasMany(Package::class, 'recipients_email');
    }

    public function deliveries(){
        if ($this->isClient()){
            throw new Exception("Client can't access deliveries method.");
        }
        return $this->hasMany(Delivery::class, 'couriers_id');
    }

    public function isAdmin()
    {
        return $this->role === 0;
    }


    public function isClient()
    {
        return $this->role === 1;
    }


    public function isCourier()
    {
        return $this->role === 2;
    }
}
