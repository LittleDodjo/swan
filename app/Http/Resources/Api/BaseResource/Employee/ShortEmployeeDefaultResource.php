<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortEmployeeDefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reason = new ReasonResource($this->reason);
        $caption = $reason->caption;
        $isAlways = $reason->is_always;
        return [
            'id' => $this->id,
            'deputy_employee' => new SmallEmployeeResource($this->deputyEmployee),
            'reason' => $caption,
            'is_always' => $isAlways,
            'form_date' => $this->fromDate,
            'to_date' => $this->toDate,
        ];
    }
}
