<?php

namespace App\Http\Resources\Api\BaseResource\Managment;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ManagmentResource extends JsonResource
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
            'employee_depends' => new ShortEmployeeResource($this->employeeDepends),
            'employee_manager' => new ShortEmployeeResource($this->employeeManager),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
        ];
    }
}
