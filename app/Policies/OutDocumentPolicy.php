<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Subsystem\Outgoing\OutDocument;
use App\Models\User;


class OutDocumentPolicy
{
    use HandlesAuthorization;
    use SubsystemPolicy;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($this->isAdmin($user)) return true;
        else return $this->isRole($user, 'isViewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        if($this->isAdmin($user)) return true;
        else return $this->isRole($user, 'isView');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if($this->isAdmin($user)) return true;
        else return $this->isRole($user, 'isCreate');
    }

    /**
     * Determine whether the user can update the model.
     * @return bool
     */
    public function update(User $user)
    {
        if($this->isAdmin($user)) return true;
        else return $this->isRole($user, 'isChange');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        if($this->isAdmin($user)) return true;
        else return $this->isRole($user, 'isDelete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        return true;
    }
}
