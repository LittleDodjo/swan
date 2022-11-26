<?php

namespace App\Http\Resources\Api\BaseResource\Management;

use App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource;
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
 */
class ManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[Pure] #[ArrayShape(['id' => "mixed", 'employee_depends' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'employee_manager' => "\App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource", 'caption' => "mixed", 'short_name' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'employee_depends' => new SmallEmployeeResource($this->employeeDepends),
            'employee_manager' => new SmallEmployeeResource($this->employeeManager),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
        ];
    }
}
