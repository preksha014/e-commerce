<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = [
        'product_id',  // Foreign key for product
        'image',  // Path where image is stored
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
