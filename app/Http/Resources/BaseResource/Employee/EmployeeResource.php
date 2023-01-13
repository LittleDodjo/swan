<?php

namespace App\Http\Resources\BaseResource\Employee;

use App\Http\Resources\BaseResource\OrganizationResource;
use App\Http\Resources\BaseResource\UserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @method fullName()
 * @method isOnWork()
 * @method onWork()
 * @method lastDefault()
 * @property mixed $id
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $patronymic
 * @property mixed $phone_number
 * @property mixed $email
 * @property mixed $rank
 * @property mixed $sex
 * @property mixed $cabinet
 * @property mixed $organization
 * @property mixed $appointment
 * @property mixed $dependency
 * @property mixed user
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
            "full_name" => $this->fullName(),
            "phone" => $this->phone_number,
            "email" => $this->email,
            "rank" => $this->rank,
            "sex" => $this->sex,
            "cabinet" => $this->cabinet,
            "is_work" => $this->onWork(),
            "user" => $this->user,
            "dependency" => new EmployeeDependencyResource($this->dependency),
            "appointment" => new AppointmentResource($this->appointment),
            "organization" => new OrganizationResource($this->organization),
            "default" => new ShortEmployeeDefaultResource( $this->lastDefault()),
        ];
    }
}
