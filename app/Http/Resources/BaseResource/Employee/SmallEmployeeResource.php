<?php

namespace App\Http\Resources\BaseResource\Employee;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed appointment
 * @property mixed last_name
 * @property mixed first_name
 * @property mixed patronymic
 * @property mixed rank
 * @property mixed id
 * @method fullName()
 */
class SmallEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape(['id' => "mixed", 'rank' => "mixed", 'full_name' => "string", 'appointment' => ""])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if($this->appointment == null) $appointment = "no!";
        else $appointment = $this->appointment->name;
        return [
            'id' => $this->id,
            'rank' => $this->rank,
            'full_name' =>  $this->fullName(),
            'appointment' => $appointment,
        ];
    }
}