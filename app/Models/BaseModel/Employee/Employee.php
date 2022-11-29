<?php

namespace App\Models\BaseModel\Employee;

use App\Models\BaseModel\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $user
 * @property mixed $first_name
 * @property mixed $patronymic
 * @property mixed $last_name
 * @property mixed $id
 * @property mixed rank
 * @property mixed dependency
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone_number',
        'email',
        'rank',
        'sex',
        'cabinet',
        'personal_data_access',
        'employee_dependency_id',
        'appointment_id',
        'user_id',
        'organization_id',
        ];

    /**
     * Аксессор ФИО
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->last_name} {$this->first_name} {$this->patronymic}";
    }

    /**
     * Отношение сотрудника к учетной записи
     * @return BelongsTo|null
     */
    public function user() : BelongsTo | null
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Возвращает true или false, привязана ли учетная запись к сотруднику
     * @return bool
     */
    public function busy(): bool
    {
        return $this->user != null;
    }

    /**
     * Связь (Один к одному) к организации сотрудника
     * @return BelongsTo | null
     */
    public function organization(): BelongsTo | null
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Связь (Один к одному) к зависимостям сотрудника
     * @return BelongsTo | null
     */
    public function dependency(): BelongsTo | null
    {
        return $this->belongsTo(EmployeeDependency::class, 'employee_dependency_id');
    }

    /**
     * @return HasMany
     */
    public function employeesDepends(): HasMany
    {
        return $this->hasMany(EmployeeDependency::class);
    }


    /**
     * Связь (Один к одному) к должности сотрудника
     * @return BelongsTo | null
     */
    public function appointment(): BelongsTo | null
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    /**
     * Связь (Один ко многим) с причинами отсутствий сотрудника
     * @return HasMany | null
     */
    public function defaults(): HasMany | null
    {
        return $this->hasMany(EmployeeDefaults::class);
    }

    /**
     * Возвращает стутс уволенного сотрудника
     * @return bool
     */
    public function defaultAlways(): bool
    {
        if (!$this->onWork()) {
            return $this->lastDefault()->always();
        }
        return false;
    }

    /**
     * Возвращает последнюю Акутальную причину отсутствия сотрудника
     * @return EmployeeDefaults|null
     */
    public function lastDefault(): EmployeeDefaults | null
    {
        return EmployeeDefaults::where('employee_id', $this->id)
            ->where('to_date', '>=', date("Y-m-d"))->get()->last();
    }

    /**
     * Находится ли сотрудник сейчас на работе
     * @return bool
     */
    public function onWork(): bool
    {
        $employeeDefault = $this->lastDefault();
        if ($employeeDefault == null) return true;
        if ($employeeDefault['to_date'] >= date("Y-m-d")) return false;
        return true;
    }
}
