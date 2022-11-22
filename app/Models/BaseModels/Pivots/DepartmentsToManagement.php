<?php

namespace App\Models\BaseModels\Pivots;

use App\Models\BaseModels\Departments\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentsToManagement extends Model
{
    use HasFactory;


    protected $fillable = [
        'department_id',
        'management_id',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
