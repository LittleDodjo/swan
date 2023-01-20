<?php

namespace App\Http\Resources\Outgoing\Stamps;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed id
 * @property mixed value
 */
class StampRegisterResourceResource extends JsonResource
{

    #[ArrayShape(['id' => "mixed", 'value' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
        ];
    }
}
