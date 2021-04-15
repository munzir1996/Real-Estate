<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'الأسم مطلوب',
            'email.required' => 'البريد الألكتروني مطلوب',
            'email.unique' => 'البريد الألكتروني مستخدم بالفعل',
            'email.email' => 'يجب ان يكون المدخل بريد ألكتروني',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف 10 ارقام',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',
            'password.required' => 'كلمة السر مطلوبة',
            'password.min' => 'طول الحد الأدني هو 8',
            'password.confirmed' => 'كلمة المرور لا تتطابق مع تأكيد كلمة المرور',
        ];
    }
}
