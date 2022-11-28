<?php

namespace App\Http\Resources\BaseResource\Employee;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed employee
 * @property mixed deputy
 * @property mixed is_always
 * @property mixed from_date
 * @property mixed to_date
 * @property mixed reason
 * @property mixed always
 * @property mixed active
 */
class DefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[Pure] #[ArrayShape(['employee' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'deputy' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'reason' => "\App\Http\Resources\BaseResource\Employee\ReasonResource", 'is_always' => "mixed", 'is_active' => "mixed", 'from' => "mixed", 'to' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'employee' => new SmallEmployeeResource($this->employee),
            'deputy' => new SmallEmployeeResource($this->deputy),
            'reason' => new ReasonResource($this->reason),
            'is_always' => $this->always(),
            'is_active' => $this->active(),
            'from' => $this->from_date,
            'to' => $this->to_date,
        ];
    }
}
