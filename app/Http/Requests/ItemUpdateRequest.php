<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'name'  => 'required|max:25',
            'stock' => 'required|integer|min:1',
            'color' => ['required|exists:colors'],
            'size'  => ['required|exists:sizes'],
            'color' => 'exists:colors,id',
            'size'  => 'exists:sizes,id'
        ];
    }
}
