<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFileParam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getParamName()
    {
        $names = [
            'product_name'=>'Название товара',
            'product_code'=>'Артикул товара',
            'product_price'=>'Цена товара',
            'product_amount'=>'Наличие товара',
            'product_description'=>'Описание товара',
            'product_photo_cover'=>'Основная фото',
            'product_photos'=>'Доп. фото',
            'brand'=>'Бренд',
            'collection'=>'Коллекция',
            'char'=>'Характеристика',
            'dop'=>'Доп.товар',
            'dop_block'=>'Блок Доп.товара',
            'seo_title'=>'SEO Title',
            'seo_description'=>'SEO Description',
            'seo_breadcrumb'=>'SEO Breadcrumb',
        ];

        return $names[$this->param];
    }

    public function excelFile()
    {
        return $this->belongsTo(ExcelFile::class);
    }

    public function char()
    {
        return $this->hasOne(Char::class, 'id', 'char_id');
    }

    public function charSettings()
    {
        return $this->hasMany(ExcelFileParamSetting::class, 'excel_file_param_id', 'id');
    }
}
