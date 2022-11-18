<?php

namespace App\Http\Resources\Api\BaseResource;

use App\Http\Resources\Api\BaseResource\Departament\ShortDepartamentResource;
use App\Models\BaseModels\Departaments\Departament;
use App\Models\BaseModels\Departaments\EmployeeDepartament;
use Illuminate\Http\Resources\Json\JsonResource;

class AllDepartamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->employee_departament_id == null) {
            $departament = Departament::find($this->departament_id);
            $type = 'mdep';
        }else{
            $departament = EmployeeDepartament::find($this->employee_departament_id);
            $type = 'edep';
        }
        $departamentResource = new ShortDepartamentResource($departament);
        return [
            'departament' => $departamentResource,
            'type' => $type,
        ];
    }
}
