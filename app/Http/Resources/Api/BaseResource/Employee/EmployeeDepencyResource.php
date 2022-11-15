<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeDepencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'employee' => new ShortEmployeeResource(Employee::find($this->employee_id)),
            'managment' => $this->managmentDepency,
            'departament' => [$this->departamentDepency, $this->employeeDepartamentDepency,]
        ];
    }
}
