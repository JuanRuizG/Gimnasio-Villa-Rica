<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
            'phone' => 'nullable',
            'email' => 'email|nullable',
            'initial_date' => 'required|date',
            'type_identification' => ['required'],
            'identification' => ['required',Rule::unique('clients')->ignore($this->route('client')->id)],
            'key_identification' => 'nullable',
            'price' => 'nullable',
            'type_monthlies_id' => 'exists:type_monthlies,id',
            'expiration_date' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.email' => 'El correo electronico no es valido',
            'initial_date.required' => 'La fecha inicial es Obligatoria',
            'type_identification.required' => 'El tipo de identificacion es obligatorio',
            'identification.required' => 'La identificacion es Obligatoria',
            'type_monthly_pay.required' => 'Eliga un tipo de mensualidad'
        ];
    }
}
