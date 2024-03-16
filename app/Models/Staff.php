<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $table="staff";
    protected $fillable=[
        'name',
        'code',
        'address',
        'email',
        'position',
        'phone_number',
        'center_id',
        'username',
        'password',
        'status',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_BLOCK = 'block';

    const POSITION_SUPPER_ADMIN = 'Super admin';
    const POSITION_ADMIN_WAREHOUSE = 'Admin warehouse';
    const POSITION_ADMIN_SHOP = 'Admin shop';
    const LIST_PERMISSION_WHEN_CREATE_STAFF = [
        self::POSITION_ADMIN_WAREHOUSE => self::POSITION_ADMIN_WAREHOUSE,
        self::POSITION_ADMIN_SHOP => self::POSITION_ADMIN_SHOP,
    ];

    public function center(){
        return $this->belongsTo(Center::class,'center_id','id');
    }

    public function getNameCenterAttribute(){
        return $this->center->name ?? "unknown";
    }
    public function getImageAvatarAttribute(){
        return $this->avatar;
    }
}
