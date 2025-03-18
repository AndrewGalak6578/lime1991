<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function keys()
    {
        return $this->hasMany(Key::class, 'key_group_id', 'id');
    }
}
