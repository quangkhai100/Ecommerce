<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'avatar'=> 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',

        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute Không được để trống',
            'max'=>':attribute Không được quá :max ký tự',
            'min'=>':attribute phai tren :min Ky tu',
            'image.max' => ':attribute Maximum file size to upload :max',
            'mimes' => ':attribute phai dinh dang như sau:jpeg,png,jpg,gif,PNG,JPG,JPEG'
        ];
    }
}
