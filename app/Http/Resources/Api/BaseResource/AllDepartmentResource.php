<?php

namespace App\Http\Resources\Api\BaseResource;

use App\Http\Resources\Api\BaseResource\Department\ShortDepartmentResource;
use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed employee_department_id
 * @property mixed department_id
 */
class AllDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['department' => "\App\Http\Resources\Api\BaseResource\Department\ShortDepartmentResource", 'type' => "string"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if ($this->employee_department_id == null) {
            $department = Department::find($this->department_id);
            $type = 'mdep';
        }else{
            $department = EmployeeDepartment::find($this->employee_department_id);
            $type = 'edep';
        }
        $departmentResource = new ShortDepartmentResource($department);
        return [
            'department' => $departmentResource,
            'type' => $type,
        ];
    }
}
