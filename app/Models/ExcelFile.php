<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'columns'=>'array'
    ];

    public function params()
    {
        return $this->hasMany(ExcelFileParam::class, 'excel_file_id', 'id');
    }

    public function getParamColumn($param)
    {
        return $this->params()->where('param', $param)->first()->column;
    }

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function names()
    {
        return $this->hasMany(ExcelFileName::class, 'excel_file_id', 'id');
    }
}
