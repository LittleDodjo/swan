<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use App\Http\Controllers\OutgoingController\Stamps\TotalPrice;
use App\Http\Resources\OutgoingResource\ShortOutgoingRegisterResource;
use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed stamps
 * @property mixed type
 * @property mixed id
 * @property mixed created_at
 * @property mixed document
 */
class StampHistoryResource extends JsonResource
{

    use TotalPrice;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'type' => "mixed", 'stamps' => "mixed", 'price' => "float|int", 'count' => "int|mixed", 'document' => "\App\Http\Resources\OutgoingResource\ShortOutgoingRegisterResource", 'date' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $totalPrice = $this->totalPrice($this);
        return [
            'id' => $this->id,
            'type' => $this->type,
            'stamps' => $this->stamps,
            'price' => $totalPrice['price'],
            'count' => $totalPrice['total'],
            'document' => new ShortOutgoingRegisterResource($this->document),
            'date' => $this->created_at,
        ];
    }
}
