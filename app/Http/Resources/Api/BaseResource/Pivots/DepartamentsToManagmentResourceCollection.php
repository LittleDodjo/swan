<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartamentsToManagmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable

     */

    public $collects = DepartamentsToManagmentResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
