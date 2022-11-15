<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\OrganizationResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortEmployeeResource extends JsonResource
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
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "patronymic" => $this->patronymic,
            "phone" => $this->phone_number,
            "email" => $this->email,
            "appointment" => new AppointmentResource($this->appointment)
        ];
    }
}
