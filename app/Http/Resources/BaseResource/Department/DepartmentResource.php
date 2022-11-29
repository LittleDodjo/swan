<?php

namespace App\Http\Resources\BaseResource\Department;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use App\Http\Resources\BaseResource\Management\ShortManagementResource;
use App\Http\Resources\BaseResource\Pivot\EmployeesToDepartmentsResourceCollection;
use App\Models\BaseModel\Pivot\EmployeesToDepartments;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use JsonSerializable;

/**
 * @property mixed code
 * @property mixed short_name
 * @property mixed caption
 * @property mixed management
 * @property mixed manager
 * @property mixed deputy
 * @property mixed id
 */
class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $employees = EmployeesToDepartments::where('department_id', 1)->get();
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'short_name' => $this->short_name,
            'code' => $this->code,
            'depends' => new ShortManagementResource($this->management),
            'manager' => new SmallEmployeeResource($this->manager),
            'deputy'  => new SmallEmployeeResource($this->deputy),
            'count' => $employees->count(),
            'employees' => new EmployeesToDepartmentsResourceCollection($employees),
        ];
    }
}
