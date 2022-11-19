<?php

namespace App\Http\Resources\Api\BaseResource;

use App\Models\BaseModels\Pivots\DepartamentsToManagment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class OrganizationResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */



    public function toArray($request)
    {
        return $this->collection;
    }
}
