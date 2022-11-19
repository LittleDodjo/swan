<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
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
            'employee' => new ShortEmployeeResource(Employee::find($this->employee_id)),
            'managment' => $this->managmentDepency,
            'departament' => [$this->departamentDepency, $this->employeeDepartamentDepency,]
        ];
    }
}
