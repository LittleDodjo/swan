<?php

namespace App\Http\Resources\Subsystem;

use Illuminate\Http\Resources\Json\JsonResource;

class OutDocumentResource extends JsonResource
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
            $this->toArray(),
        ];
    }
}
