<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use App\Models\OutgoingModel\Stamps\StampHistory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class StampBalanceHistoryResourceCollection extends ResourceCollection
{

    public $collects = StampBalanceResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
