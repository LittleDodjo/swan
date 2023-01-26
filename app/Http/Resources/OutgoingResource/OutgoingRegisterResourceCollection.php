<?php

namespace App\Http\Resources\OutgoingResource;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @method currentPage()
 * @method lastPage()
 */
class OutgoingRegisterResourceCollection extends ResourceCollection
{

    public $collects = ShortOutgoingRegisterResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['data' => "array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable", 'page' => "mixed", 'total' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => parent::toArray($request),
            'page' => $this->currentPage(),
            'total' => $this->lastPage(),
        ];
    }
}
