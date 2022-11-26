<?php

namespace App\Http\Resources\BaseResource;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed short_name
 * @property mixed name
 */
class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['name' => "mixed", 'short_name' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'name' => $this->name,
            'short_name' => $this->short_name,
        ];
    }
}