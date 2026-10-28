<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;

class Product extends Model
{
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}
}