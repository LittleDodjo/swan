<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Subsystem\Outgoing\OutDocument;
use App\Models\User;


class OutDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OutDocument $outDocument)
    {
        return (bool)true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return (bool)true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OutDocument $outDocument)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OutDocument $outDocument)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subsystem\Outgoing\OutDocument  $outDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OutDocument $outDocument)
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
    public function forceDelete(User $user, OutDocument $outDocument)
    {
        return true;
    }
}
