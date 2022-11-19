<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class SmallEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => "$this->last_name $this->first_name $this->patronymic",
            'appointment' => $this->appointment->caption
        ];
    }
}
