<?php

namespace App\Http\Resources\Api\BaseResource\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
/**
 * @property mixed id
 * @property mixed caption
 * @property mixed short_name
 * @property mixed is_manager
 * @property mixed is_primary_manager
 */
class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'caption' => "mixed", 'short_name' => "mixed", 'is_manager' => "mixed", 'is_primary' => "mixed"])]
    public function toArray($request): array
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
