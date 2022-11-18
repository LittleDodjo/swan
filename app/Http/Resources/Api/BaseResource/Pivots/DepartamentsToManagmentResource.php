<?php

namespace App\Http\Resources\Api\BaseResource\Pivots;

use App\Http\Resources\Api\BaseResource\Departament\DepartamentResource;
use App\Http\Resources\Api\BaseResource\Departament\ShortDepartamentResource;
use App\Http\Resources\Api\BaseResource\Managment\ManagmentResource;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentsToManagmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function toArray($request)
    {
        return [
            'departament' => new ShortDepartamentResource(
                Departament::find($this->departament_id)),
        ];
    }
}
