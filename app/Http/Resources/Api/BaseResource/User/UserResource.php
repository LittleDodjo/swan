<?php

namespace App\Http\Resources\Api\BaseResource\User;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed id
 * @property mixed login
 * @property mixed is_confirmed
 * @property mixed created_at
 * @property mixed employee
 * @property mixed globalRoles
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[Pure] #[ArrayShape(['id' => "mixed", 'login' => "mixed", 'is_confirmed' => "mixed", 'created_at' => "mixed", 'employee' => "\App\Http\Resources\Api\BaseResource\Employee\EmployeeResource", 'roles' => "\App\Http\Resources\Api\BaseResource\User\UserRolesResource"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'is_confirmed' => $this->is_confirmed,
            'created_at' => $this->created_at,
            'employee' => new EmployeeResource($this->employee),
            'roles' => new UserRolesResource($this->globalRoles),
        ];
    }
}
