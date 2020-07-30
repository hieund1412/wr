<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'required|max:191|email',
        ];
    }
    public function messages(){
        return[
            'email.required'=>'Email không được để trống ! ',
            'email.max'=>'Email tối đa :max ký tự ! ',
            'email.email'=>'Email phai thuoc dinh dang abc@gmail.com ! ',
        ];
    }
}
