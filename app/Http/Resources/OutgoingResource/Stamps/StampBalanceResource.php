<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use App\Http\Resources\BaseResource\Employee\SmallEmployeeResource;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $type
 * @property mixed $employee
 * @property mixed $balance
 * @property mixed $id
 */
class StampBalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'employee' => "\App\Http\Resources\BaseResource\Employee\SmallEmployeeResource", 'type' => "mixed", 'balance' => "array"])]
    public function toArray($request): array
    {
        $a = [];
        foreach ($this->balance as $key => $value){
            $a[] = new StampRegisterResourceResource(StampRegister::find($key));
        }
        return [
            'id' => $this->id,
            'employee' => new SmallEmployeeResource($this->employee),
            'type' => $this->type,
            'balance' => $a,
        ];
    }
}
