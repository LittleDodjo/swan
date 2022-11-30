<?php

namespace App\Models\BaseModel\Pivot;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Management\Management;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentsToManagements extends Model
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

    public function management(): BelongsTo
    {
        return $this->belongsTo(Management::class);
    }
}
