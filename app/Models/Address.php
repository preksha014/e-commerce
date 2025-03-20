<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    //
    use HasFactory;
    protected $fillable = ['customer_id', 'street', 'city', 'zipcode', 'recipient_name'];

    public function customer() {
        return $this->belongsTo(User::class);
    }
}
