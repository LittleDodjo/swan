<?php

namespace App\Http\Resources\BaseResource\Employee;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @property mixed appointment
 * @property mixed sex
 * @property mixed email
 * @property mixed phone_number
 * @property mixed patronymic
 * @property mixed last_name
 * @property mixed first_name
 * @property mixed id
 * @method onWork()
 */
class ShortEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */


    #[ArrayShape(["id" => "mixed", "first_name" => "mixed", "last_name" => "mixed", "patronymic" => "mixed", "phone" => "mixed", "email" => "mixed", 'sex' => "mixed", 'is_work' => "", "appointment" => "\App\Http\Resources\Api\BaseResource\Employee\AppointmentResource"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "patronymic" => $this->patronymic,
            "phone" => $this->phone_number,
            "email" => $this->email,
            'sex' => $this->sex,
            'is_work' => $this->onWork(),
            "appointment" => new AppointmentResource($this->appointment),
        ];
    }
}
