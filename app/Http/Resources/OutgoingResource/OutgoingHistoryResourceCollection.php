<?php

namespace App\Http\Resources\OutgoingResource;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class OutgoingHistoryResourceCollection extends ResourceCollection
{

    public $collects = OutgoingHistoryResource::class;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
