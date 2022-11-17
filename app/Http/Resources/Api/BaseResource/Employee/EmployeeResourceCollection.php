<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $collects = ShortEmployeeResource::class;


    public function toArray($request)
    {
        return parent::toArray($request);
    }
}