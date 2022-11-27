<?php

namespace App\Http\Resources\BaseResource\Department;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed $caption
 * @property mixed $id
 */
class ShortDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'caption' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
        ];
    }
}
