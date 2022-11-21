<?php

namespace App\Http\Requests\Api\BaseRequest\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRolesRequest extends FormRequest
{

    /**
     * @var string
     * Пароль суперпользователя
     */
    private $rootPassword = "123456";


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
    public function rules()
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
