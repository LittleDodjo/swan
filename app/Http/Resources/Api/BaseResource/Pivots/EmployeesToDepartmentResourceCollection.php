<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use Illuminate\Contracts\Support\Arrayable as ArableAlias;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class EmployeesToDepartmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|ArableAlias|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|ArableAlias
    {
        return parent::toArray($request);
    }
}
