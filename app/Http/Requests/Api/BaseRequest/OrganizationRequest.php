<?php

namespace App\Http\Requests\Api\BaseRequest;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class OrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'short_name' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required',
            'short_name' => 'required',
        ];
    }

    #[ArrayShape(['name.required' => "string", 'short_name.required' => "string"])] public function messages(): array
    {
        return [
            'name.required' => 'Необходимо указать имя организации',
            'short_name.required' => 'Необходимо указать короткое имя организации'
        ];
    }
}
