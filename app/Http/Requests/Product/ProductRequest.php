<?php

namespace App\Http\Requests\Product;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:255',
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
           'file.required' => 'Ảnh file không được để trống và phải đúng định dạng ảnh',
            'file.image' => 'Ảnh file  phải đúng định dạng ảnh',
          
        ];
    }
 
}
