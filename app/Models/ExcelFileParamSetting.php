<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFileParamSetting extends Model
{
    use HasFactory;

    protected $fillable = ['excel_file_param_id', 'char_value_id', 'excel_name'];

    public function param()
    {
        return $this->hasOne(ExcelFileParam::class, 'id', 'excel_file_param_id');
    }

    public function charValue()
    {
        return $this->hasOne(CharValue::class, 'id', 'char_value_id');
    }
}
