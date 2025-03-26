<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaticPage extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'status'];
}
