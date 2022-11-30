<?php

namespace App\Http\Resources\BaseResource\Pivot;

use App\Http\Resources\BaseResource\Pivot\AllDepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllDepartmentResourceCollection extends ResourceCollection
{

    public $collects = AllDepartmentResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
