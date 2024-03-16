<?php

namespace App\Models;

use App\Http\Controllers\Traits\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAddNumberProduct extends Model
{
    use HasFactory, BelongsToCenter;
    protected $table = 'history_add_number_product';
    protected $fillable = [
        'product_id',
        'number',
        'code',
        'price',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function getImageProductAttribute(){
        return $this->product->image ?? '';
    }
    public function getCodeProductAttribute(){
        return $this->product->code ?? '';
    }
    public function getNameProductAttribute(){
        return $this->product->name ?? '';
    }
    public function getMeasurementUnitProductAttribute(){
        return $this->product->measurement_unit ?? '';
    }
    public function getCenterNameProductAttribute(){
        return $this->product->measurement_unit ?? '';
    }
}
