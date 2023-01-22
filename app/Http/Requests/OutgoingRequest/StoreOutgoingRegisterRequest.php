<?php

namespace App\Http\Requests\OutgoingRequest;

use App\Rules\OutgoingRule\OutgoingRegister\DepartureDataEqualsRule;
use App\Rules\OutgoingRule\OutgoingRegister\DepartureDataRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $departure_data
 */
class StoreOutgoingRegisterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'message_type' => 'boolean',
            'copies_count' => 'integer',
            'envelopes_count' => 'integer',
            'lists_count' => 'integer',
            'registration_number' => 'string|required',
            'registration_date' => 'before_or_equal:now|required',
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
            'stamps_used.*.count' => 'integer|min:1|required|sometimes'
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
