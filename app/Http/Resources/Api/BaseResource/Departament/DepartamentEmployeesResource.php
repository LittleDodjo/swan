<?php

namespace App\Http\Resources\Api\BaseResource\Departament;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentEmployeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return new $this->employees;
    }
}
