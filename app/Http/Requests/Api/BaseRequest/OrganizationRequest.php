<?php

namespace App\Http\Requests\Api\BaseRequest;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name' => 'required',
            'short_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать имя организации',
            'short_name.required' => 'Необходимо указать короткое имя организации'
        ];
    }
}
