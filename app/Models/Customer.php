<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $table = "customers";
    protected $guarded=[];

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
