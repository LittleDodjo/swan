<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class StampRegisterResourceCollection extends ResourceCollection
{

    public $collects = StampRegisterResource::class;


    /**
     * @param $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
