<?php

namespace App\Http\DBS\Pyramid\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PyramidConfigurationRequest extends FormRequest
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
            'another_pyramid' => 'required|numeric',
            'another_zone' => 'required|numeric',
            'level_up' => 'required|numeric',
            'level_down' => 'required|numeric',
        ];
    }
}
