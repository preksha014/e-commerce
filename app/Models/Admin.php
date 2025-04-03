<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'admins';

    public $fillable = [
        "name",
        "email",
        "password",
        "role_id",
        "status",
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}