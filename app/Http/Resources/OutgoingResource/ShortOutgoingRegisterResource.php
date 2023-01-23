<?php

namespace App\Http\Resources\OutgoingResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed registration_number
 * @property mixed registration_date
 * @property mixed message_type
 * @property mixed departure_data
 * @property mixed created_at
 */
class ShortOutgoingRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['registrationNumber' => "mixed", 'registrationDate' => "mixed", 'message_type' => "mixed", 'departure' => "mixed", 'created' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'registrationNumber' => $this->registration_number,
            'registrationDate' => $this->registration_date,
            'message_type' => $this->message_type,
            'departure' => $this->departure_data,
            'created' => $this->created_at,
        ];
    }
}
