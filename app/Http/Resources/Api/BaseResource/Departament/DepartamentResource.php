<?php

namespace App\Http\Resources\Api\BaseResource\Departament;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResource;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Http\Resources\Api\BaseResource\Managment\ManagmentResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class DepartamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        if (isset($this->employee_depends)){
            $depends = new ShortEmployeeResource(Employee::find($this->employee_depends));
        }
        else {
            $depends = new ManagmentResource(Managment::find($this->managment_depends));
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
