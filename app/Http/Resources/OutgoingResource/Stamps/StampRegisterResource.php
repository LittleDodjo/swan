<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed value
 * @property mixed count
 * @property mixed id
 */
class StampRegisterResource extends JsonResource
{


    /**
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'value' => "mixed", 'count' => "mixed", 'total' => "float|int"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'count' => $this->count,
            'total' => $this->count *$this->value,
        ];
    }
}
