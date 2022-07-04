<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required',
            'type_identification' => ['required'],
            'identification' => 'required|unique:clients,identification',
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'initial_date' => 'required|date',
            'type_monthlies_id' => 'exists:type_monthlies,id',
            'key_identification' => 'nullable',
            'price' => 'nullable',
            'expiration_date' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'initial_date.required' => 'La fecha inicial es Obligatoria',
            'email.email' => 'El correo electronico no es valido',
            'type_identification.required' => 'El tipo de identificacion es obligatorio',
            'identification.required' => 'La identificacion es Obligatoria',
            'type_monthly_pay.required' => 'Eliga un tipo de mensualidad'
        ];
    }
}
