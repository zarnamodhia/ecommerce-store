<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_address',
        'payment_method',
        // add more fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
