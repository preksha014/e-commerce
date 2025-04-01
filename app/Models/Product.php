<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'price',
        'color',
        'size',
        'quantity',
        'status',
        'slug'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isInWishlist()
    {
        $wishlist = session()->get('wishlist', []);
        return isset($wishlist[$this->id]);
    }
}