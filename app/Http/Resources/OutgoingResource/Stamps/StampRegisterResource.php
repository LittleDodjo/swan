<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed value
 * @property mixed count
 * @property mixed id
 */
class StampRegisterResource extends JsonResource
{

    #[ArrayShape(['id' => "mixed", 'value' => "mixed", 'count' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'count' => $this->count,
        ];
    }
}
