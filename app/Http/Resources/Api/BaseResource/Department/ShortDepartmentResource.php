<?php

namespace App\Http\Resources\Api\BaseResource\Department;

use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed employee_primary_manager_id
 * @property mixed employee_manager_id
 * @property mixed caption
 * @property mixed short_name
 * @property mixed display_number
 */
class ShortDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'primary_manager_id' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'manager_id' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'caption' => "mixed", 'short_name' => "mixed", 'code' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'primary_manager_id' => new ShortEmployeeResource(Employee::find($this->employee_primary_manager_id)),
            'manager_id' => new ShortEmployeeResource(Employee::find($this->employee_manager_id)),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
            'code' => $this->display_number,

        ];
    }
}
