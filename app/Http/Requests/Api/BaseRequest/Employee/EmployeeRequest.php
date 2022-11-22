<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:25|string',
            'last_name' => 'required|min:3|max:25|string',
            'patronymic' => 'string|min:3|max:20',
            'phone_number' => 'required|string',
            'appointment_id' => 'required|integer',
            'depency_id' => 'integer',
            'organization_id' => 'required',
            'email' => 'required|email|unique:employees,email',
            'cabinet' => 'required|string',
            'sex' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Имя указать обязательно',
            'first_name.min' => 'Имя должно быть не менее 3 символов',
            'first_name.max' => 'Имя должно быть не более 25 символов',
            'first_name.string' => 'Ошибка указания Имени',
            'last_name.required' => 'Фамилия обязательное поле',
            'last_name.min' => 'Минимальная длинна фамилии 3',
            'last_name.max' => 'Максимальная длинна фамилии 25',
            'last_name.string' => 'Ошибка указания Фамилии',
            'patronymic.string' => 'Ошибка указания отчества',
            'patronymic.max' => 'Максимальная длиа Отчества не более 20 символов',
            'patronymic.min' => 'Минимальная длина Отчества не менее 3 символов',
            'phone_number.required' => 'Номер телефона укзаать обязательно',
            'phone_number.string' => 'Ошибка - неверный формат номера телефона',
            'appointment_id.required' => 'Должность нужно указать обязательно',
            'appointment_id.integer' => 'Ошибка указания должности',
            'depency_id.integer' => 'Ошибка указания зависимости',
            'email.required' => 'Необходимо указать почту',
            'email.email' => 'Неверный формат почты',
            'email.unique' => 'Такая почта уже существует в системе',
            'organization_id.required' => 'Необходимо указать организацию',
            'cabinet.required' => 'Нужно указать кабинет',
            'cabinet.string' => 'Неверный формат данных кабинета',
            'sex.boolean'=> 'Неверный формат данных пола',
        ];
    }
}
