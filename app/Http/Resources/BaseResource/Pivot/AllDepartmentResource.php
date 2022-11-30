<?php

namespace App\Http\Resources\BaseResource\Pivot;

use App\Http\Resources\BaseResource\Department\ShortDepartmentResource;
use App\Http\Resources\BaseResource\Department\ShortEmployeeDepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * @property mixed department
 * @property mixed employeeDepartment
 */
class AllDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[Pure] #[ArrayShape(['department' => "\App\Http\Resources\BaseResource\Department\ShortDepartmentResource|\App\Http\Resources\BaseResource\Department\ShortEmployeeDepartmentResource", 'type' => "string"])]
    public function toArray($request): array
    {
        if($this->department != null){
            $data = [
                'department' => new ShortDepartmentResource($this->department),
                'type' => 'mdep',
            ];
        }else{
            $data = [
                'department' => new ShortEmployeeDepartmentResource($this->employeeDepartment),
                'type' => 'edep',
            ];
        }
        return $data;
    }
}
