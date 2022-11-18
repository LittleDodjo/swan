<?php

namespace App\Http\Resources\Api\BaseResource;

use App\Models\BaseModels\Pivots\DepartamentsToManagment;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */



    public function toArray($request)
    {
        return $this->collection;
    }
}
