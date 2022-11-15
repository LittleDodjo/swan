<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'short_name' => $this->short_name,
            'is_manager' => $this->is_manager,
            'is_primary' => $this->is_primary_manager,
        ];
    }
}
