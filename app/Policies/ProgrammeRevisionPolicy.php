<?php

namespace App\Policies;

use App\Programme;
use App\ProgrammeRevision;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgrammeRevisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any programme revisions.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny', Programme::class);
    }

    /**
     * Determine whether the user can view the programme revision.
     *
     * @param  \App\User  $user
     * @param  \App\ProgrammeRevision  $programmeRevision
     *
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view', Programme::class);
    }

    /**
     * Determine whether the user can create programme revisions.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('update', Programme::class);
    }

    /**
     * Determine whether the user can update the programme revision.
     *
     * @param  \App\User  $user
     * @param  \App\ProgrammeRevision  $programmeRevision
     *
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can('update', Programme::class);
    }

    /**
     * Determine whether the user can delete the programme revision.
     *
     * @param  \App\User  $user
     * @param  \App\ProgrammeRevision  $programmeRevision
     *
     * @return mixed
     */
    public function delete(User $user, ProgrammeRevision $programmeRevision)
    {
        return $user->can('update', Programme::class)
            && $programmeRevision->programme->revisions->count() > 1;
    }
}
