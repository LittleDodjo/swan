<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\OrganizationResource;
use App\Models\BaseModels\Employees\EmployeeDepency;
use App\Models\BaseModels\Organization;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EmployeeResource extends JsonResource
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
            "is_work" => $this->isOnWork(),
            "rank" => $this->rank,
            "sex" => $this->sex,
            "depency" => new EmployeeDepencyResource($this->employeeDepency),
            "appointment" => new AppointmentResource($this->appointment),
            "organization" => new OrganizationResource($this->organization),
            "default" => new ShortEmployeeDefaultResource( $this->lastDefault()),
        ];
    }
}
