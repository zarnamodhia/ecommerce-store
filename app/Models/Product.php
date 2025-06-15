<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image','category_id'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
