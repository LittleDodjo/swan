<?php

namespace App\Http\Requests\OutgoingRequest\Stamps;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $balance
 * @property mixed $type
 */
class StoreStampBalanceRequest extends FormRequest
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
            'balance' => 'array|required',
            'balance.*.id' => 'exists:stamp_registers,id|required',
            'balance.*.count' => 'min:1|integer|required',
        ];
    }
}
