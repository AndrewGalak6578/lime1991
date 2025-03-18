<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function group()
    {
        return $this->hasOne(KeyGroup::class, 'id', 'key_group_id');
    }
}
