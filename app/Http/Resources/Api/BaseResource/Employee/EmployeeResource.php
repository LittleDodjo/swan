<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\OrganizationResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed id
 * @property mixed first_name
 * @property mixed patronymic
 * @property mixed last_name
 * @property mixed phone_number
 * @property mixed email
 * @property mixed sex
 * @property mixed rank
 * @property mixed cabinet
 * @property mixed employeeDependency
 * @property mixed appointment
 * @property mixed organization
 * @method isOnWork()
 * @method lastDefault()
 * @method fullName()
 */
class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {

        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "patronymic" => $this->patronymic,
            "fullname" => $this->fullName(),
            "phone" => $this->phone_number,
            "email" => $this->email,
            "is_work" => $this->isOnWork(),
            "rank" => $this->rank,
            "sex" => $this->sex,
            "cabinet" => $this->cabinet,
            "dependency" => new EmployeeDependencyResource($this->employeeDependency),
            "appointment" => new AppointmentResource($this->appointment),
            "organization" => new OrganizationResource($this->organization),
            "default" => new ShortEmployeeDefaultResource( $this->lastDefault()),
        ];
    }
}
