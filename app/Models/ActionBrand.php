<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;

class ActionBrand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function action()
    {
        return $this->hasOne(Action::class, 'id', 'action_id');
    }
    public function brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

}
