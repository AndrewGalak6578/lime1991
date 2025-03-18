<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'city_id',
        'street',
        'home',
        'apartment',
        'comment',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullName()
    {
        return $this->name.' '.$this->last_name;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id');
    }

    public function address()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }

    public function getUserCartTotal()
    {
        $total = 0;
        foreach ($this->carts()->get() as $cart){
            $total = $total + $cart->itemPrice();
        }
        return $total;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function bproducts()
    {
        return $this->hasManyThrough(
            OrderProduct::class,
            Order::class,
            'user_id', // Foreign key on the environments table...
            'order_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }

    public function hasBoughtProduct($id)
    {
        return $this->bproducts()->where('product_id', $id)->exists();
    }

    public function hasNoReview($id)
    {
        return $this->reviews()->where('product_id', $id)->doesntExist();
    }

    public function coupons(){
        return $this->belongsToMany(Coupon::class, 'user_coupons')->withPivot('status')->using(UserCoupon::class);
    }

    public function getActiveCoupon()
    {
        return $this->coupons()
            ->wherePivot('user_coupons.status', 1)
            ->where('coupons.status', 1)
            ->where('coupons.available_until', '>', now());
    }
}
