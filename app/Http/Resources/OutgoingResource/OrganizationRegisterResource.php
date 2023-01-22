<?php

namespace App\Http\Resources\OutgoingResource;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $id
 * @property mixed $index
 * @property mixed $city
 * @property mixed $street
 * @property mixed $number
 * @property mixed $name
 */
class OrganizationRegisterResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'index' => "mixed", 'city' => "mixed", 'street' => "mixed", 'number' => "mixed", 'name' => "mixed", 'fullName' => "string"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'index' => $this->index,
            'city' => $this->city,
            'street' => $this->street,
            'number' => $this->number,
            'name' => $this->name,
            'fullName' => "$this->index, г. $this->city, ул. $this->street, д. $this->number, $this->name",
        ];
    }
}
