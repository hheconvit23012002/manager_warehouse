<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="center";
    protected $fillable = [
        'name',
        'code',
        'address',
        'address2',
        'type',
        'logo',
        'email',
        'phone_number',
        'bank_account_number',
        'bank_account_mame',
        'tax_code',
    ];

    const TYPE_WAREHOUSE = 'warehouse';
    const TYPE_SHOP = 'shop';
    const LIST_TYPE = [
        self::TYPE_WAREHOUSE => self::TYPE_WAREHOUSE,
        self::TYPE_SHOP => self::TYPE_SHOP,
    ];

    public function getImageLogoAttribute(){
        return $this->logo;
    }
    public function getAddressDetailAttribute(){
        return $this->address2 . "-" . $this->address;
    }
    public function getBankInfoAttribute(){
        return $this->bank_account_mame . "-" . $this->bank_account_number;
    }
}
