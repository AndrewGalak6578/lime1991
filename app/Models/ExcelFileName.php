<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFileName extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function excelFile()
    {
        return $this->hasOne(ExcelFile::class, 'id', 'excel_file_id');
    }

    public function param()
    {
        return $this->hasOne(ExcelFileParam::class, 'id', 'type');
    }

    public function getParam()
    {
        if($this->type == 0){
            return $this->text;
        }else{
            $param_name = $this->param->getParamName();
            if($param_name == 'Характеристика' AND $this->param?->char_id != 0){
                $char = ': '.$this->param?->char?->name;
            }else{
                $char = '';
            }
            return $param_name.' '.$char;
        }
    }
}
