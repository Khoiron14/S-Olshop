<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $rules = [
            'image' => 'image|mimes:jpeg,bmp,png'
        ];

        if ($this->description != null) {
            $rules['description'] = 'string|max:500';
        }

        if (!$this->user()->hasRole('seller')) { // if user create store
            $rules['name'] = 'required|max:25|unique:stores';
            $rules['domain'] = 'required|max:15|alpha_dash|regex:/^[a-z0-9]+$/|unique:stores';
        }

        return $rules;
    }
}
