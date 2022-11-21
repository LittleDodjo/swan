<?php

namespace App\Http\Resources\Api\BaseResource\User;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'login' => $this->login,
            'is_confirmed' => $this->is_confirmed,
            'created_at' => $this->created_at,
            'employee' => new EmployeeResource($this->employee),
            'roles' => new UserRolesResource($this->globalRoles),
        ];
    }
}
