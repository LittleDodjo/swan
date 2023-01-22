<?php

namespace App\Http\Resources\OutgoingResource;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class OrganizationRegisterResourceCollection extends ResourceCollection
{


    public $collects = OrganizationRegisterResource::class;

    /**
     * @param $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
