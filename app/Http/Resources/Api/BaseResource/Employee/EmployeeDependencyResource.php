<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\Department\DepartmentEmployeesResource;
use App\Http\Resources\Api\BaseResource\Department\DepartmentResource;
use App\Http\Resources\Api\BaseResource\Management\ManagementResource;
use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;


/**
 * @property mixed employeeDepartmentDependency
 * @property mixed department_id
 * @property mixed management_id
 * @property mixed employee_id
 * @property mixed id
 */
class EmployeeDependencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'employee_depends' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'management_depends' => "\App\Http\Resources\Api\BaseResource\Management\ManagementResource", 'department_depends' => "\App\Http\Resources\Api\BaseResource\Department\DepartmentResource", 'employee_department_depends' => "\App\Http\Resources\Api\BaseResource\Department\DepartmentEmployeesResource"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'employee_depends' => new ShortEmployeeResource(Employee::find($this->employee_id)),
            'management_depends' => new ManagementResource(Management::find($this->management_id)),
            'department_depends' => new DepartmentResource(Department::find($this->department_id)),
            'employee_department_depends' => new DepartmentEmployeesResource(EmployeeDepartment::find($this->employeeDepartmentDependency)),
        ];
    }
}
