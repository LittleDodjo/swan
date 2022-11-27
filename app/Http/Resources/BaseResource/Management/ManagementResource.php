<?php

namespace App\Http\Resources\BaseResource\Management;

use App\Http\Resources\BaseResource\Department\DepartmentResource;
use App\Http\Resources\BaseResource\Department\DepartmentResourceCollection;
use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed employeeDepends
 * @property mixed employeeManager
 * @property mixed caption
 * @property mixed short_name
 * @property mixed id
 * @property mixed $manager
 * @property mixed $depends
 * @property mixed $departments
 */
class ManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'employee_depends' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'employee_manager' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'departments' => "\App\Http\Resources\BaseResource\Department\DepartmentResourceCollection", 'caption' => "mixed", 'short_name' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'employee_depends' => new SmallEmployeeResource($this->depends),
            'employee_manager' => new SmallEmployeeResource($this->manager),
            'departments' => new DepartmentResourceCollection($this->departments),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
        ];
    }
}
