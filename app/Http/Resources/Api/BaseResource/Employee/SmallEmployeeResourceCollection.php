<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SmallEmployeeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $collects = SmallEmployeeResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
