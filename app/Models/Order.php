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

    const STATUS_PENDING = 'status-pending';
    const STATUS_ACCEPT = 'status-accept';
    const STATUS_REJECT = 'status-reject';

    public function requester(){
        return $this->belongsTo(Center::class,'request_id','id');
    }
    public function seller(){
        return $this->belongsTo(Center::class,'seller_id','id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_detail','order_id','product_id')
            ->withPivot(['price','number','tax']);
    }
    public function getRequestNameAttribute(){
        return ($this->requester ?? "")->name ?? "";
    }
}
