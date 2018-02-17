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
            'description' => 'required|string|max:500',
        ];

        if ($this->user()->hasRole('seller')) { // if seller want to update store
            $rules['name'] = 'required|max:25|unique:stores,name,' . $this->store->id;
        } else { // if user create store
            $rules['name'] = 'required|max:25|unique:stores';
            $rules['domain'] = 'required|max:15|alpha_dash|unique:stores';
            $rules['image'] = 'required|image|mimes:jpeg,bmp,png';
        }

        return $rules;
    }
}
