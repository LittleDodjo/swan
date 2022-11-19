<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesToDepartamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return new SmallEmployeeResource(Employee::find($this->employee_id));
    }
}
