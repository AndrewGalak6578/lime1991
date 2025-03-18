<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_coupons');
    }

    public function brands()
    {
        return $this->hasMany(CouponBrand::class, 'coupon_id', 'id');
    }
   
}
