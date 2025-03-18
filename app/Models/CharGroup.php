<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function chars()
    {
        return $this->hasMany(Char::class, 'char_group_id', 'id');
    }
}
