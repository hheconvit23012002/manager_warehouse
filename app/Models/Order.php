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
        'code',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_DELIVERY = 'delivery';
    const STATUS_DONE = 'done';
    const STATUS_REJECT = 'reject';

    const STATUS_LIST = [
        self::STATUS_PENDING => self::STATUS_PENDING,
        self::STATUS_DELIVERY => self::STATUS_DELIVERY,
        self::STATUS_DONE => self::STATUS_DONE,
        self::STATUS_REJECT => self::STATUS_REJECT,
    ];

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
