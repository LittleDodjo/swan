<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class DepartamentsToManagmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
 */

    public $collects = DepartamentsToManagmentResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
