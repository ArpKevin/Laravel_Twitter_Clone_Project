<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePinRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pin_name' => 'required',
            'pin_description' => 'required',
            'latitude' => 'required|numeric|min:48.059131|max:48.086029',
            'longitude' => 'required|numeric|min:19.262767|max:19.311605',
            'pin_category_id' => 'required|exists:pin_categories,id'
        ];
    }
}
