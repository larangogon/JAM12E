<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'name_recipient'      => 'required|min:2|max:20',
            'phone_recipient'     => 'required|min:2|numeric',
            'cellphone_recipient' => 'required|min:2|numeric',
            'document_recipient'  => 'required|min:2|numeric',
            'address_recipient'   => 'required|min:2|max:20',
            'email_recipient'     => 'required|min:2|max:40',
            'country_recipient'   => 'required|min:2|max:20',
            'city_recipient'      => 'required|min:2|max:20'
        ];
    }
}
