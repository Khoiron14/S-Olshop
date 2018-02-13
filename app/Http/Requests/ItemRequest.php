<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:40',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'images.*' => 'required'
        ];

        if ($this->file('images')) {
            $images = count($this->file('images'));
            foreach(range(0, $images) as $index) {
                $rules['images.' . $index] = 'image|mimes:jpeg,bmp,png';
            }
        }

        return $rules;
    }
}
