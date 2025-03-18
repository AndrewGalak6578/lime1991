<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Coupon;

class CouponBrand extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function action()
    {
        return $this->hasOne(Coupon::class, 'id', 'action_id');
    }
    public function brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

}
