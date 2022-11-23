<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(mixed $employee_id)
 * @method static create(array $array_merge)
 * @property mixed user_id
 * @property mixed user
 * @property mixed appointment
 * @property mixed id
 * @property mixed patronymic
 * @property mixed first_name
 * @property mixed last_name
 */
class Employee extends Model
{
    use HasFactory;

    /**
     * Параметры модели
     * @var string[]
     */
    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'patronymic',
        'phone_number',
        'appointment_id',
        'employee_dependency_id',
        'user_id',
        'email',
        'personal_data_access',
        'rank',
        'sex',
        'cabinet'
    ];

    /**
     * Связь (один к одному) к учетной записи
     * @return BelongsTo | null
     */
    public function user(): BelongsTo | null
    {
        return $this->belongsTo(User::class);
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
    public function employeeDependency(): BelongsTo | null
    {
        return $this->belongsTo(EmployeeDependency::class);
    }

    /**
     * Связь (Один к одному) к должности сотрудника
     * @return BelongsTo | null
     */
    public function appointment(): BelongsTo | null
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Связь (Один ко многим) с причинами отсутствий сотрудника
     * @return HasMany | null
     */
    public function employeeDefault(): HasMany | null
    {
        return $this->hasMany(EmployeeDefaults::class);
    }

    /**
     * Получить полное имя (ФИО)
     * @return string
     */
    public function fullName(): string
    {
        return "$this->last_name $this->first_name $this->patronymic";
    }

    /**
     * Является ли заместителем руководителя данный сотрудник
     * @return mixed
     */
    public function isManager(): mixed
    {
        return $this->appointment->is_manager;
    }

    /**
     * Является ли Руководителем данный сотрудник
     * @return mixed
     */
    public function isPrimaryManager(): mixed
    {
        return $this->appointment->is_primary_manager;
    }


    /**
     * Является ли сотрудник персоналом, который контролирует делопроизводство
     * @return mixed
     */
    public function isControlManager(): mixed
    {
        return $this->user->globalRoles->is_control_manager;
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
    public function isOnWork(): bool
    {
        $employeeDefault = $this->lastDefault();
        if ($employeeDefault == null) return true;
        if ($employeeDefault['to_date'] >= date("Y-m-d")) return false;
        return true;
    }

    /**
     *
     * @return bool
     */
    public function isAlwaysDefault(): bool
    {
        if (!$this->isOnWork()) {
            return $this->lastDefault()->isAlways();
        }
        return false;
    }

    /**
     * Привязана ли учетная запись к сотруднику
     * @return bool
     *
     */
    public function isBusy(): bool
    {
        return $this->user != null;
    }
}
