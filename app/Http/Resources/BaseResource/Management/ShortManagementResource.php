<?php

namespace App\Http\Resources\BaseResource\Management;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

/**
 * @property mixed short_name
 * @property mixed depends
 * @property mixed manager
 * @property mixed caption
 * @property mixed id
 */
class ShortManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[Pure] #[ArrayShape(['id' => "mixed", 'depends' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'manager' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'caption' => "mixed", 'short_name' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'depends' => new SmallEmployeeResource($this->depends),
            'manager' => new SmallEmployeeResource($this->manager),
            'caption' => $this->caption,
            'short_name' => $this->short_name,
        ];
    }
}
