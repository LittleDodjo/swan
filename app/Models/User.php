<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BaseModels\Employees\Employee;
use App\Models\Subsystem\Outgoing\OutDocument;
use App\Models\Subsystem\Outgoing\OutUsersRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(){
        return $this->hasOne(Employee::class);
    }

    /**
     *
     * Отношение учетной записи к глобальным ролям (Один к одному)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function globalRoles()
    {
        return $this->hasOne(UserRoles::class);
    }


    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
