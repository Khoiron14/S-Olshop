<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:25|unique:stores',
            'domain' => 'required|max:15|alpha_dash|unique:stores',
            'avatar' => 'required',
            'description' => 'required|string|max:500',
        ];
    }
}
