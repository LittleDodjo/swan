<?php

namespace App\Http\Resources\OutgoingResource;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResourceResource;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed employee
 * @property mixed created_at
 * @property mixed stamps_used
 * @property mixed departure_data
 * @property mixed copies
 * @property mixed lists_count
 * @property mixed envelopes_count
 * @property mixed registration_date
 * @property mixed registration_number
 * @property mixed history
 * @property mixed message_type
 */
class OutgoingRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $stamps = [];
        foreach ($this->stamps_used as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamps[] = [
                'id' => $stamp->id,
                'value' => $stamp->value,
                'used' => $value['count']
            ];
        }
        return [
            'registrationNumber' => $this->registration_number,
            'registrationDate' => $this->registration_date,
            'envelopes' => $this->envelopes_count,
            'lists' => $this->lists_count,
            'copies' => $this->copies,
            'departure' => $this->departure_data,
            'stamps' => $stamps,
            'created' => $this->created_at,
            'type' => $this->message_type,
            'author' => new SmallEmployeeResource($this->employee),
            'history' => new OutgoingHistoryResourceCollection($this->history),
        ];
    }
}
