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




    public function changeCart($productId, $number){
        $cartDetail = $this->cartDetail->where('product_id',$productId)->first();
        $product = Product::query()->where('id', $productId)->firstOrFail();
        if(is_null($cartDetail)){
            if($product->number < $number){
                throw new \Exception('Product empty');
            }
            $cartDetail = $this->cartDetail()->create([
                'product_id' => $productId,
                'number' => intval($number),
            ]);
        }else{
            $cartDetail->number = $cartDetail->number + intval($number);
            if($product->number < $cartDetail->number){
                throw new \Exception('Product empty');
            }
            $cartDetail->save();
        }
        if($cartDetail->number <= 0 ){
            $cartDetail->delete();
            return 0;
        }
        return $cartDetail->number;

    }

    public function enterNumberProduct($productId, $number){
        $query = $this->cartDetail->where('product_id',$productId);
        $product = Product::query()->where('id', $productId)
            ->where('number', '>=', intval($number))
            ->first();

        if($number <= 0){
            $query->first()->delete();
            return 0;
        }
        $cartDetail = $query->firstOrFail();
        if(!is_null($product)){
            $cartDetail->number = intval($number);
            $cartDetail->save();
        }

        return $cartDetail->number;

    }
}
