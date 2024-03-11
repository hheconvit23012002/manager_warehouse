<?php

namespace App\Models;

use App\Http\Controllers\Traits\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxProduct extends Model
{
    use HasFactory, BelongsToCenter;
    protected $table="tax_product";
    protected $fillable=[
        'number',
        'center_id',
    ];
}
