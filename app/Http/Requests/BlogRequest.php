<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'image'=> 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
        ];
    }
    public function messages()
    {
        return [
            'image' => ':attribute phai la hình ảnh',
            'mimes' => ':attribute phai dinh dang như sau:jpeg,png,jpg,gif,PNG,JPG,JPEG',
            'image.max' => ':attribute Maximum file size to upload :max'
        ];
    }
}
