<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Managments\Managment;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ManagmentToDepartaments extends Pivot
{
    protected $fillable = [
        'departament_id',
        'managment_id',
    ];


    public function employees(){
        return $this->hasMany(Managment::class);
    }


}
