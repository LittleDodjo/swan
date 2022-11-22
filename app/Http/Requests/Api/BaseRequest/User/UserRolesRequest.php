<?php

namespace App\Http\Requests\Api\BaseRequest\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed password
 * @property mixed user_id
 */
class UserRolesRequest extends FormRequest
{

    /**
     * @var string
     * Пароль суперпользователя
     */
    private string $rootPassword = "123456";


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $can = Auth::user()->can('update', Auth::user()->globalRoles);
        if (!$can && $this->password != $this->rootPassword) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['password' => "string", 'user_id' => "string", 'is_root' => "string", 'is_admin' => "string", 'is_control_manager' => "string"])] public function rules(): array
    {
        return [
            'password' => 'required',
            'user_id' => 'required|integer',
            'is_root' => 'boolean',
            'is_admin' => 'boolean',
            'is_control_manager' => 'boolean',
        ];
    }
}
