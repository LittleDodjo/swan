<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortEmployeeDepencyResource extends JsonResource
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
            'employee_depends' => new SmallEmployeeResource(Employee::find($this->employee_id)),
        ];
    }
}
