<?php

namespace App\Http\Resources\BaseResource\Management;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ManagementResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $collects = ManagementResource::class;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
