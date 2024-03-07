<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $table="account";
    protected $fillable=[
        'username',
        'password',
        'staff_id',
        'status',
    ];
    protected $hidden = [
        'password',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCK = 'block';
    public function staff(){
        return $this->belongsTo(Staff::class,"staff_id","id");
    }

    public function scopeWithFilter($searchFilter){

    }
}
