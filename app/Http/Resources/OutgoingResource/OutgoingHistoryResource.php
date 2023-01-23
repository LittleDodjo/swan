<?php

namespace App\Http\Resources\OutgoingResource;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed created_at
 * @property mixed employee
 * @property mixed touched_fields
 */
class OutgoingHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['fields' => "mixed", 'employee' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'date' => "mixed"])] #[Pure]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'fields' => $this->touched_fields,
            'employee' => new SmallEmployeeResource($this->employee),
            'date' => $this->created_at,
        ];
    }
}
