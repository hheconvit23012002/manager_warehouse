<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="order";
    protected $fillable=[
        'request_id',
        'shipping_address',
        'seller_id',
        'phone_number',
        'desc',
        'estimated_delivery_date',
        'status',
    ];
}
