<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed stamps
 * @property mixed type
 * @property mixed id
 * @property mixed created_at
 */
class StampHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'type' => "mixed", 'stamps' => "mixed", 'date' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'stamps' => $this->stamps,
            'date' => $this->created_at,
        ];
    }
}
