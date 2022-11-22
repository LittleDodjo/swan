<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ShortEmployeeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */

    public $collects = ShortEmployeeResource::class;

    public function toArray($request)
    {
        return $this->collection;
    }
}
