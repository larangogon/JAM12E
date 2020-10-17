<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ItemCreateRequest extends FormRequest
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
            'name'        => 'required|max:25',
            'description' => 'required|max:250',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'img'         => 'required',
            'color'       => ['required'],'exists:colors,id',
            'category'    => ['required'],'exists:colors,id',
            'size'        => ['required'],'exists:sizes,id',
        ];
    }
}
