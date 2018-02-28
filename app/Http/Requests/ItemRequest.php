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
        ];

        // if adding item, image is required
        if (!$this->item) {
            $rules['images'] = 'required';
        }

        // if user want to upload images
        if ($this->file('images')) {
            foreach($this->file('images') as $image) {
                $rules['images'] = 'image|mimes:jpeg,bmp,png';
            }
        }

        return $rules;
    }
}
