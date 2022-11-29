<?php

namespace App\Http\Resources\BaseResource\Department;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed caption
 * @property mixed id
 */
class ShortEmployeeDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'caption' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
        ];
    }
}
