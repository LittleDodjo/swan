<?php

namespace App\Models\BaseModels\Employees;

use App\Models\BaseModels\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'employee_depency_id',
        'user_id',
        'email',
        'personal_data_access',
    ];


    /**
     * Скрытые параметры
     * @var string[]
     */
    protected $hidden = [
        'rank',
    ];


    /**
     * Связь (один к одному) к учетной записи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь (Один к одному) к организации сотрудника
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Связь (Один к одному) к зависимостям сотрудника
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employeeDepency()
    {
        return $this->belongsTo(EmployeeDepency::class);
    }

    /**
     * Связь (Один к одному) к должности сотрудника
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Связь (Один ко многим) с причинами отсутствий сотрудника
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeDefault()
    {
        return $this->hasMany(EmployeeDefaults::class);
    }

    /**
     * Является ли заместителем руководителя данный сотрудник
     * @return mixed
     */
    public function isManager()
    {
        return $this->appointment->is_manager;
    }

    /**
     * Является ли Руководителем данный сотрудник
     * @return mixed
     */
    public function isPrimaryManager()
    {
        return $this->appointment->is_primary_manager;
    }

    /**
     * Является ли сотрудник персоналом, который контролирует делопроизводство
     * @return mixed
     */
    public function isControlManager()
    {
        return $this->user->globalRoles->is_control_manager;
    }

    /**
     * Возвращает последнюю Акутальную причину отсутствия сотрудника
     * @return mixed
     */
    public function lastDefault()
    {
        $employeeDefault = EmployeeDefaults::where('employee_id', $this->id)
            ->where('toDate', '>=', date("Y-m-d"))->get()->last();
        return $employeeDefault;
    }

    /**
     * Находится ли сотрудник сейчас на работе
     * @return bool
     */
    public function isOnWork()
    {
        $employeeDefault = $this->lastDefault();
        if ($employeeDefault == null) return true;
        if ($employeeDefault['toDate'] >= date("Y-m-d")) return false;
        return true;
    }

    /**
     * Привязана ли учетная запись к сотруднику
     * @return bool
     *
     */
    public function isBusy()
    {
        return $this->user != null;
    }
}
