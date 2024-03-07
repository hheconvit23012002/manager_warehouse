<?php

namespace App\Models;

use App\Http\Controllers\Traits\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, BelongsToCenter;
    protected $table="product";
    protected $fillable=[
        'code',
        'name',
        'measurement_unit',
        'price',
        'category_id',
        'des',
        'image',
        'created_id',
        'tax_id',
        'center_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function tax(){
        return $this->belongsTo(TaxProduct::class,'tax_id','id');
    }

    public function getCategoryNameAttribute(){
        return $this->category->name ?? "unknown";
    }
    public function getTaxNumberAttribute(){
        return $this->tax->number ?? "unknown";
    }
}
