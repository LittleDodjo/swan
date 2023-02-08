<?php

namespace App\Http\Resources\OutgoingResource;

use App\Http\Controllers\OutgoingController\Stamps\TotalPrice;
use App\Models\BaseModel\Employee\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
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
    public function toArray($request): array
    {
        $type = array_key_first($this->departure_data);
        $name = 'none';
        $stamps = 0;
        if(Arr::exists($this->departure_data[$type], 'name')) {
            $name = $this->departure_data[$type]['name'];
        }

        foreach ($this->stamps() as $key => $value){
            $stamps += $value['count'];
        }
        return [
            'id' => $this->id,
            'registrationNumber' => $this->registration_number,
            'stamps' => $stamps,
            'executor' => Employee::find($this->executor_id)->fullName(),
            'executorId' => $this->executor_id,
            'registrationDate' => $this->registration_date,
            'messageType' => $this->message_type,
            'departureType' => $type,
            'departureDate' => $this->departure_data[$type]['date'],
            'departureAddress' => $this->departure_data[$type]['address'],
            'name' =>  $name,
            'departure' => $this->departure_data,
            'created' => $this->created_at,
        ];
    }
}
