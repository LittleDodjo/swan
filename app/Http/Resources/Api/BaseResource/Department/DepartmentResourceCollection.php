<?php

namespace App\Http\Resources\Api\BaseResource\Department;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $collects = ShortDepartmentResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
