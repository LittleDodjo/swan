<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed to_date
 * @property mixed from_date
 * @property mixed deputyEmployee
 * @property mixed employee
 * @property mixed id
 * @property mixed reason
 */
class EmployeeDefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'employee' => "\App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource", 'deputy_employee' => "\App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource", 'reason' => "mixed", 'is_always' => "mixed", 'from' => "mixed", 'to' => "mixed"])] #[Pure]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $reason = new ReasonResource($this->reason);
        $caption = $reason->caption;
        $isAlways = $reason->is_always;
        return [
            'id' => $this->id,
            'employee' => new SmallEmployeeResource($this->employee),
            'deputy_employee' => new SmallEmployeeResource($this->deputyEmployee),
            'reason' => $caption,
            'is_always' => $isAlways,
            'from' => $this->from_date,
            'to' => $this->to_date,
        ];

    }
}
