<?php

namespace App\Models;

use App\Http\Controllers\Traits\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, BelongsToCenter;
    protected $table="category";
    protected $fillable=[
        'name',
        'des',
        'center_id',
    ];
}
