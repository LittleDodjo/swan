<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Http\Resources\Api\BaseResource\Departament\DepartamentEmployeesResource;
use App\Http\Resources\Api\BaseResource\Departament\DepartamentResource;
use App\Http\Resources\Api\BaseResource\Managment\ManagmentResource;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EmployeeDepencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_depends' => new ShortEmployeeResource(Employee::find($this->employee_id)),
            'managment_depends' => new ManagmentResource(Managment::find($this->managment_id)),
            'departament_depends' => new DepartamentResource(Departament::find($this->departament_id)),
            'employee_departament_depends' => new DepartamentEmployeesResource(EmployeeDepartament::find($this->employeeDepartamentDepency)),
        ];
    }
}
