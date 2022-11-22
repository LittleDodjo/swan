<?php

namespace App\Http\Resources\Api\BaseResource\Department;

use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Http\Resources\Api\BaseResource\Management\ManagementResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed management_depends
 * @property mixed id
 * @property mixed employee_primary_manager_id
 * @property mixed employee_manager_id
 * @property mixed caption
 * @property mixed short_name
 * @property mixed display_number
 * @property mixed employees
 */
class DepartmentResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'depends' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource|\App\Http\Resources\Api\BaseResource\Management\ManagementResource", 'primary_manager_id' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'manager_id' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'caption' => "mixed", 'short_name' => "mixed", 'code' => "mixed", 'employees' => "mixed"])]
    public function toArray($request): array
    {
        if (isset($this->employee_depends)){
            $depends = new ShortEmployeeResource(Employee::find($this->employee_depends));
        }
        else {
            $depends = new ManagementResource(Management::find($this->management_depends));
        }
        return [
            'id' => $this->id,
            'depends' => $depends,
            'primary_manager_id' => new ShortEmployeeResource(Employee::find($this->employee_primary_manager_id)),
            'manager_id' => new ShortEmployeeResource(Employee::find($this->employee_manager_id)),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
            'code' => $this->display_number,
            'employees' => $this->employees
        ];
    }
}
