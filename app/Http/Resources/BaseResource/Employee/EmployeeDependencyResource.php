<?php

namespace App\Http\Resources\BaseResource\Employee;

use App\Http\Resources\BaseResource\Department\DepartmentResource;
use App\Http\Resources\BaseResource\Department\EmployeeDepartmentResource;
use App\Http\Resources\BaseResource\Management\ManagementResource;
use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $employee_id
 * @property mixed $management_id
 * @property mixed $department_id
 * @property mixed $employeeDepartmentDependency
 * @property mixed $id
 */
class EmployeeDependencyResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'employee_depends' => "\App\Http\Resources\BaseResource\Employee\ShortEmployeeResource", 'management_depends' => "\App\Http\Resources\BaseResource\Management\ManagementResource", 'department_depends' => "\App\Http\Resources\BaseResource\Department\DepartmentResource", 'employee_department_depends' => "\App\Http\Resources\BaseResource\Department\EmployeeDepartmentResource"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'employee_depends' => new SmallEmployeeResource(Employee::find($this->employee_id)),
            'management_depends' => new ManagementResource(Management::find($this->management_id)),
            'department_depends' => new DepartmentResource(Department::find($this->department_id)),
            'employee_department_depends' => new EmployeeDepartmentResource(EmployeeDepartment::find($this->employeeDepartmentDependency)),
        ];
    }
}
