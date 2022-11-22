<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed employee_id
 */
class ShortEmployeeDependencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['employee_depends' => "\App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource"])] public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'employee_depends' => new SmallEmployeeResource(Employee::find($this->employee_id)),
        ];
    }
}
