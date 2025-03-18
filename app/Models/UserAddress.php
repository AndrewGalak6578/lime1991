<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

//    public function save(array $options = array())
//    {
//        $this->user_id = auth()->id();
//        parent::save($options);
//    }

    public function getAddress()
    {
        return 'г. '.$this->city.' ул. '.$this->street.' дом.'.$this->house.$this->getApartment();
    }

    public function getApartment()
    {
        return ($this->apartment != null) ? ' кв/оф.'.$this->apartment.' этаж.'.$this->floor.' подъезд.'.$this->entrance : '';
    }
}
