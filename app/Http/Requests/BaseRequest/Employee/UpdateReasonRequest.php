<?php

namespace App\Http\Requests\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateReasonRequest extends FormRequest
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
    #[ArrayShape(['caption' => "string", 'is_always' => "string"])]
    public function rules(): array
    {
        return [
            'caption' => 'min:1',
            'is_always' => 'boolean',
        ];
    }


    #[ArrayShape(['caption.min' => "string", 'is_always.boolean' => "string"])]
    public function messages(): array
    {
        return [
            'caption.min' => 'Слишком короткое имя',
            'is_always.boolean' => 'Неверный формат данных',
        ];
    }
}
