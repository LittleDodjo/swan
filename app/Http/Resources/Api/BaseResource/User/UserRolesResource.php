<?php

namespace App\Http\Resources\Api\BaseResource\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRolesResource extends JsonResource
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
            'is_admin' => $this->is_admin,
            'is_root' => $this->is_root,
            'is_control_manager' => $this->is_control_manager,
        ];
    }
}
