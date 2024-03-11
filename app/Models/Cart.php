<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table="cart";
    protected $fillable=[
        'request_id',
        'seller_id',
    ];

    public function cartDetail(){
        return $this->hasMany(CartDetail::class,'cart_id','id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'cart_detail','cart_id','product_id')
            ->withPivot(['number']);
    }




    public function addToCart($productId){
        $cartDetail = $this->cartDetail->where('product_id',$productId)->first();
        if(is_null($cartDetail)){
            $this->cartDetail()->create([
                'product_id' => $productId,
                'number' => 1,
            ]);
        }else{
            $cartDetail->number = $cartDetail->number +1;
            $cartDetail->save();
        }

    }
}
