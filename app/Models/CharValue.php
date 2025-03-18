<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    #характеристика
    public function char()
    {
        return $this->hasOne(Char::class, 'id', 'char_id');
    }
}
