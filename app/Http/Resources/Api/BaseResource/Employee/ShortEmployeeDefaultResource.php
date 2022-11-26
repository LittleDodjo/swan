<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * @property mixed deputyEmployee
 * @property mixed reason
 * @property mixed id
 * @property mixed from_date
 * @property mixed to_date
 */
class ShortEmployeeDefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[Pure] #[ArrayShape(['id' => "mixed", 'deputy_employee' => "\App\Http\Resources\Api\BaseResource\Employee\SmallEmployeeResource", 'reason' => "mixed", 'is_always' => "mixed", 'form_date' => "mixed", 'to_date' => "mixed"])]
    public function toArray($request): array
    {
        $reason = new ReasonResource($this->reason);
        $caption = $reason->caption;
        $isAlways = $reason->is_always;
        return [
            'id' => $this->id,
            'deputy_employee' => new SmallEmployeeResource($this->deputyEmployee),
            'reason' => $caption,
            'is_always' => $isAlways,
            'form_date' => $this->from_date,
            'to_date' => $this->to_date,
        ];
    }
}
