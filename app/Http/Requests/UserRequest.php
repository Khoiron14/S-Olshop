<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:25|unique:users,name,' . auth()->user()->id,
            'email' => 'required|string|email|max:25|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|string|max:25|unique:users,phone,' . auth()->user()->id,
            'address' => 'required|string|max:100',
            'image' => 'image|mimes:jpeg,bmp,png',
        ];
    }
}
