<?php

namespace App\Http\Requests\BaseRequest;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => 'min:5',
            'short_name' => 'min:5',
        ];
    }

    #[ArrayShape(['name.min' => "string", 'short_name.min' => "string"])]
    public function messages(): array
    {
        return [
            'name.min' => 'Минимальная длинная наименования - 5 символов',
            'short_name.min' => 'Минимальная длина короткого имени - 5 символов',
        ];
    }
}
