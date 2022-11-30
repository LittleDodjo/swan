<?php

namespace App\Http\Resources\BaseResource\Pivot;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class EmployeesToDepartmentsResourceCollection extends ResourceCollection
{


    public $collects = EmployeesToDepartmentsResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
