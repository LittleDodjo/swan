<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use App\Http\Resources\Api\BaseResource\Department\DepartmentResource;
use App\Http\Resources\Api\BaseResource\Department\ShortDepartmentResource;
use App\Http\Resources\Api\BaseResource\Management\ManagementResource;
use App\Models\BaseModels\Departments\Department;
use App\Models\BaseModels\Managements\Management;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed department_id
 */
class DepartmentsToManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */


    #[ArrayShape(['department' => '\App\Http\Resources\Api\BaseResource\Department\ShortDepartmentResource'])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'department' => new ShortDepartmentResource(
                Department::find($this->department_id)),
        ];
    }
}
