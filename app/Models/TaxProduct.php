<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxProduct extends Model
{
    use HasFactory;
    protected $table="tax_product";
    protected $fillable=[
        'number',
        'center_id',
    ];
}
