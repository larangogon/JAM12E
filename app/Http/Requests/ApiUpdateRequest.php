<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateRequest extends FormRequest
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
            'stock' => 'required|integer|min:0',
            'color' => ['required'],
            'size'  => ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        abort(response()->json(['errors' => $validator->errors()->toArray()

        ]));
    }
}
