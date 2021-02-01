<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer','max:255'],
            'multipleImage'=> 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'multipleImage'=> 'max:3',

        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute Không được để trống',
            'max'=>':attribute Không được quá :max ký tự',
            'image' => ':attribute phai la hình ảnh',
            'mimes' => ':attribute phai dinh dang như sau:jpeg,png,jpg,gif,PNG,JPG,JPEG',
            'multipleImage.max' => ':attribute Maximum file size to upload :max',
            'multipleImage.max' => 'Only 3 images are allowed',
        ];
    }
}
