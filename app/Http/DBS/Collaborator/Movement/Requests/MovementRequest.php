<?php

namespace App\Http\DBS\Collaborator\Movement\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
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
            'pyramid_id' => 'required',
            'level_id' => 'required',
            'sector_id' => 'required',
            'check_in_date' => 'required',
        ];
    }
}
