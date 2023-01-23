<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use App\Models\OutgoingModel\Stamps\StampBalance;
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

    #[ArrayShape(['id' => "mixed", 'value' => "mixed", 'count' => "mixed"])] public function
    toArray($request): array|JsonSerializable|Arrayable
    {
        $balance = StampBalance::orderby('id', 'desc')->first();
        return [
            'id' => $this->id,
            'value' => $this->value,
            'count' => $balance->balance[$this->id],
        ];
    }
}
