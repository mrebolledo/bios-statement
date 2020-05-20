<?php

namespace App\Http\Client\Extra;

use Illuminate\Foundation\Http\FormRequest;

class StatementRequest extends FormRequest
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
            'rut' => 'required',
            'phone' => 'required|max:9|min:9',
            'email' => 'required|email',
            'statement_1' => 'required',
            'statement_2' => 'required',
            'statement_3' => 'required',
            'statement_4' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'rut.required' => 'Campo RUT obligatorio, ej: 11111111-1',
            'phone.required' => 'Teléfono es obligatorio ej: 956996991',
            'email.required' => 'Campo Email Obligatorio',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'statement_1.required' => 'Para enviar la declaración es obligatorio que este campo tenga marcada una de las opciones',
            'statement_2.required' => 'Para enviar la declaración es obligatorio que este campo tenga marcada una de las opciones',
            'statement_3.required' => 'Para enviar la declaración es obligatorio que este campo tenga marcada una de las opciones',
            'statement_4.required' => 'Para enviar la declaración es obligatorio que este campo tenga marcada una de las opciones',
        ];
    }
}
