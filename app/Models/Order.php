<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'subtotal', 'discount', 'shipping', 'tax', 
        'total_amount', 'status', 'payment_method', 'payment_status',
        'payment_gateway_order_id', 'payment_id', 'payment_signature',
        'first_name', 'last_name', 'email', 'phone', 'address', 'city',
        'state', 'country', 'pincode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
