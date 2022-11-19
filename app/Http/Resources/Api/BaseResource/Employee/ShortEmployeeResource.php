<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\OrganizationResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShortEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
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
            "appointment" => new AppointmentResource($this->appointment),
            'is_work' => $this->isOnWork(),
            'is_manager' => $this->isManager(),
        ];
    }
}
