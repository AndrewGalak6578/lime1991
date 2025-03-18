<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     public $statusTexts = [
        '0'  => 'Заказ создан',
        '1'  => 'На сборке',
        '2'  => 'На доставке',
        '3'  => 'Отменен',
        '4'  => 'Завершен',
        '5'  => 'Ожидает оплату',
        '6'  => 'Ошибка оплаты',
    ];

     public $statusInfo = [
         '0'  => [
             'class'=>'btn btn-secondary',
             'text'=> 'Заказ создан'
         ],
         '1'  => [
             'class'=> 'btn btn-info',
             'text'=> 'На сборке',
         ],
         '2'  => [
             'class'=> 'btn btn-primary',
             'text'=> 'На доставке',
         ],
         '3'  => [
             'class'=> 'btn btn-dark',
             'text'=> 'Отменен',
         ],
         '4'  => [
             'class'=> 'btn btn-success',
             'text'=> 'Завершен',
         ],
         '5'  => [
             'class'=> 'btn btn-info',
             'text'=> 'Ожидает оплату',
         ],
         '6'  => [
             'class'=> 'btn btn-danger',
             'text'=> 'Ошибка оплаты',
         ]
     ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function hasProduct($id)
    {
        return $this->products()->where('product_id', $id)->exists();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getDeliveryPrice()
    {
        return ($this->delivery_price != 'Уточнять у менеджера') ? $this->delivery_price.'₽' : 'Уточняйте у менеджера';
    }

    public function getAllTotal()
    {
        return ($this->delivery_price != 'Уточнять у менеджера') ? intval($this->amount)+intval($this->delivery_price) : $this->amount;
    }

    public function getStatus()
    {
        return $this->statusTexts[$this->status];
    }

    public function getStatusButton()
    {
        return '<button class="'.$this->statusInfo[$this->status]['class'].'">'.$this->statusTexts[$this->status].'</button>';
    }

    public function clientName()
    {
        return $this->name.' '.$this->last_name;
    }

    public function orderDateTime()
    {
        return date_format($this->created_at, 'd.m.Y H:i');
    }
}
