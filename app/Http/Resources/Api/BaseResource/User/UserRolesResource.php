<?php

namespace App\Http\Resources\Api\BaseResource\User;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed is_control_manager
 * @property mixed is_root
 * @property mixed is_admin
 */
class UserRolesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['is_admin' => "mixed", 'is_root' => "mixed", 'is_control_manager' => "mixed"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'is_admin' => $this->is_admin,
            'is_root' => $this->is_root,
            'is_control_manager' => $this->is_control_manager,
        ];
    }
}
