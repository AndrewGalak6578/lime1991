<?php

namespace App\Http\Requests\Admin\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreExcelFileNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
//        $table->integer('excel_file_id');
//        $table->integer('type')->default(0); //0-free text, any-another- param
//        $table->integer('excel_file_param_id')->default(0);
//        $table->string('text')->nullable();
        return [
            'excel_file_id'=>'required|integer',
            'type'=>'required',
            'text'=>'nullable'
        ];
    }
}
