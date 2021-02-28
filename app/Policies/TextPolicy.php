<?php

namespace App\Policies;

use App\Models\Text;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->tokenCan('text:list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Text  $text
     * @return mixed
     */
    public function view(User $user, Text $text)
    {
        return $user->tokenCan('text:view') && $user->id == $text->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->tokenCan('text:upload');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Text  $text
     * @return mixed
     */
    public function delete(User $user, Text $text)
    {
        return $user->tokenCan('text:delete') && $user->id == $text->user_id;
    }
}
