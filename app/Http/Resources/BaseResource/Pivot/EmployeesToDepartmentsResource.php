<?php

namespace App\Http\Resources\BaseResource\Pivot;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\Pure;

/**
 * @property mixed employee
 */
class EmployeesToDepartmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return SmallEmployeeResource
     */
    #[Pure] public function toArray($request): SmallEmployeeResource
    {
        return new SmallEmployeeResource($this->employee);
    }
}
