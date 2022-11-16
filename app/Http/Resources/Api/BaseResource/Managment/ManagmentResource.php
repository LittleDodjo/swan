<?php

namespace App\Http\Resources\Api\BaseResource\Managment;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagmentResource extends JsonResource
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
            'employee_depends' => new ShortEmployeeResource($this->employeeDepends),
            'employee_manager' => new ShortEmployeeResource($this->employeeManager),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
        ];
    }
}
