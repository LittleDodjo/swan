<?php

namespace App\Http\Resources\BaseResource;

use App\Http\Resources\BaseResource\Employee\EmployeeResource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed $role
 * @property mixed $login
 * @property mixed $id
 * @property mixed $employee
 * @property mixed is_confirmed
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[Pure] #[ArrayShape(['id' => "mixed", 'login' => "mixed", 'role' => "\App\Http\Resources\BaseResource\UserRoleResource", 'employee' => "\App\Http\Resources\BaseResource\Employee\EmployeeResource"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'is_confirmed' => $this->is_confirmed,
            'role' => new UserRoleResource($this->role),
            'employee' => new EmployeeResource($this->employee),
        ];
    }
}
