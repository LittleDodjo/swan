<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed employee_id
 */
class EmployeesToDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return SmallEmployeeResource|array|JsonSerializable|Arrayable
     */
    public function toArray($request): SmallEmployeeResource|array|JsonSerializable|Arrayable
    {
        return new SmallEmployeeResource(Employee::find($this->employee_id));
    }
}
