<?php

namespace App\Http\Requests\Api\BaseRequest\User;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
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
    #[ArrayShape(['login' => "string", 'password' => "string"])]
    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required',
        ];
    }

    #[ArrayShape(['login.required' => "string", 'password.required' => "string"])]
    public function messages(): array
    {
        return [
            'login.required' => 'Необходимо оказать логин',
            'password.required' => 'Необходимо указать пароль',
        ];
    }
}
