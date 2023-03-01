<?php

namespace App\Http\Requests\OutgoingRequest;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property mixed $departure_data
 * @property mixed message_type
 * @property mixed departure_type
 * @property mixed departure_address
 * @property mixed departure_date
 * @property mixed departure_name
 */
class UpdateOutgoingRegisterRequest extends FormRequest
{



    protected function prepareForValidation()
    {
        $this->merge([
            'message_type' => $this->message_type == 1,
            'departure_data' => [
                $this->departure_type => [
                    'date' => $this->departure_date,
                    'address' => $this->departure_address,
                    'name' => $this->departure_name
                ]
            ],
        ]);
    }
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
    public function rules(): array
    {
        return [
            'registration_number' => 'string',
            'registration_date' => 'before_or_equal:now',
            'departure_data.mail' => 'array|nullable',
            'departure_data.mail.address' => [
                'sometimes',
                'email',
                'required',
            ],
            'departure_data.mail.date' => [
                'sometimes',
                'required',
                'before_or_equal:now',
            ],
            'departure_data.organization' => 'array|nullable',
            'departure_data.organization.address' => [
                'sometimes',
                'exists:organization_registers,id',
                'required'
            ],
            'departure_data.organization.date' => [
                'sometimes',
                'before_or_equal:now',
                'required'
            ],
            'departure_data.people' => 'array|nullable',
            'departure_data.people.name' => [
                'sometimes',
                'string',
                'required',
            ],
            'departure_data.people.address' => [
                'required',
                'sometimes',
                'string',
            ],
            'departure_data.people.date' => [
                'sometimes',
                'before_or_equal:now',
                'required'
            ],
            'stamps_used' => 'array|nullable',
            'stamps_used.*.id' => 'exists:stamp_registers,id|required|sometimes',
            'stamps_used.*.count' => 'integer|min:1|required|sometimes',
            'executor_id' => 'exists:employees,id|required',
            'lists_count' => 'min:1|integer',
            'message_type' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'registration_number.string' => 'Неверный формат регистрационного номера',
            'departure_data.mail.array' => 'Неверный формат данных (почта)',
            'departure_data.mail.address.email' => 'Неверный формат электронной почты',
            'departure_data.mail.address.required' => 'Необходимо указать адрес электронной почты',
            'departure_data.mail.date.required' => 'Необходимо указать дату отправки',
            'departure_data.mail.date.before_or_equal' => 'Дата должна быть не позднее текущей даты',
            'departure_data.organization.array' => 'Неверный формат данных (Организация)',
            'departure_data.organization.address.exists' => 'Такой организации не найдено в реестре',
            'departure_data.organization.address.required' => 'Необходимо указать адрес организации',
            'departure_data.organization.date.required' => 'Необходимо указать дату отправки',
            'departure_data.organization.date.before_or_equal' => 'Дата должна быть не позднее текущей даты',
            'departure_data.people.array' => 'Неверный формат данных (Организация)',
            'departure_data.people.address.string' => 'Неверный формат данных адреса',
            'departure_data.people.address.required' => 'Необходимо указать адрес доставки',
            'departure_data.people.date.required' => 'Необходимо указать дату отправки',
            'departure_data.people.date.before_or_equal' => 'Дата должна быть не позднее текущей даты',
            'departure_data.people.name.string' => 'Неверный формат ФИО получателя',
            'departure_data.people.name.required' => 'Необходимо указать ФИО получателя',
            'stamps_used.array' => 'Неверный формат данных полученных от клиента',
            'stamps_used.*.id.exists' => 'Марки такого номинала не найдено в реестре',
            'stamps_used.*.id.required' => 'Обязательно необходимо указать идентификатор марки в реестре',
            'stamps_used.*.count.required' => 'Обязательно необходимо указать количество марок',
            'stamps_used.*.count.integer' => 'Неверный формат данных',
            'stamps_used.*.count.min' => 'Марок должно быть не менее 1',
            'envelopes_count.min' => 'Минимальное количество конвертов 1',
            'envelopes_count.integer' => 'Неверный формат данных количества конвертов',
            'lists_count.min' => 'Минимальное количество конвертов 1',
            'lists_count.integer' => 'Неверный формат данных количества конвертов',
            'copies_count.min' => 'Минимальное количество конвертов 1',
            'copies_count.integer' => 'Неверный формат данных количества конвертов',
            'message_type.boolean' => 'Неверный формат данных типа письма',
        ];
    }
}
