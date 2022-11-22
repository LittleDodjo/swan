<?php

namespace App\Models;

use App\Models\BaseModels\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @property mixed globalRoles
 * @property mixed|string password
 * @property mixed id
 * @method static find(mixed $user_id)
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'is_confirmed',
        'user_roles_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Отношение учетной записи к сотруднику (Один к одному)
     * @return HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    /**
     *
     * Отношение учетной записи к глобальным ролям (Один к одному)
     * @return HasOne
     */
    public function globalRoles(): HasOne
    {
        return $this->hasOne(UserRoles::class);
    }


    /**
     * Проверка, является ли учетная запись суперпользователем
     * @return bool
     */
    public function isRoot(): bool
    {
        return (bool)$this->globalRoles->is_root;
    }

    /**
     * Проверка, является ли учетная запись контролирующего пользователя
     * @return bool
     */
    public function isControlManager(): bool
    {
        return (bool)$this->globalRoles->is_control_manager;
    }

    /**
     * Проверка является ли учетная запись администратором
     * @return bool
     */
    public function isAdmin(): bool
    {
        return (bool)$this->globalRoles->is_admin;
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
