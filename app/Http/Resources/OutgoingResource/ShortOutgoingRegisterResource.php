<?php

namespace App\Http\Resources\OutgoingResource;

use App\Models\BaseModel\Employee\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed registration_number
 * @property mixed registration_date
 * @property mixed message_type
 * @property mixed departure_data
 * @property mixed created_at
 * @property mixed id
 * @property mixed executor_id
 * @method stamps()
 */
class ShortOutgoingRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'registrationNumber' => "mixed", 'stamps' => "", 'executor' => "mixed", 'executorId' => "mixed", 'registrationDate' => "mixed", 'messageType' => "mixed", 'departure' => "mixed", 'created' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'registrationNumber' => $this->registration_number,
            'stamps' => $this->stamps(),
            'executor' => Employee::find($this->executor_id)->fullName(),
            'executorId' => $this->executor_id,
            'registrationDate' => $this->registration_date,
            'messageType' => $this->message_type,
            'departure' => $this->departure_data,
            'created' => $this->created_at,
        ];
    }
}
