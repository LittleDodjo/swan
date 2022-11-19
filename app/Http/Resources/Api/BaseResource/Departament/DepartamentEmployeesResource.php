<?php

namespace App\Http\Resources\Api\BaseResource\Departament;

use App\Http\Resources\Api\BaseResource\Employee\EmployeeResourceCollection;
use App\Http\Resources\Api\BaseResource\Employee\ShortEmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class DepartamentEmployeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return $this->employees;
    }
}
