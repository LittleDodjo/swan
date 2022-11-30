<?php

namespace App\Http\Resources\BaseResource\Department;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use App\Http\Resources\BaseResource\Management\ShortManagementResource;
use App\Http\Resources\BaseResource\Pivot\EmployeesToDepartmentsResourceCollection;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed id
 * @property mixed caption
 * @property mixed short_name
 * @property mixed management
 * @property mixed manager
 * @property mixed deputy
 * @property mixed code
 * @property mixed depends
 */
class EmployeeDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'caption' => "mixed", 'short_name' => "mixed", 'code' => "mixed", 'depends' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'manager' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'deputy' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'count' => "mixed", 'employees' => "\App\Http\Resources\BaseResource\Pivot\EmployeesToDepartmentsResourceCollection"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $employees = EmployeesToDepartments::where('employee_department_id', 1)->get();
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'short_name' => $this->short_name,
            'code' => $this->code,
            'depends' => new SmallEmployeeResource($this->depends),
            'manager' => new SmallEmployeeResource($this->manager),
            'deputy' => new SmallEmployeeResource($this->deputy),
            'count' => $employees->count(),
            'employees' => new EmployeesToDepartmentsResourceCollection($employees),
        ];
    }
}
