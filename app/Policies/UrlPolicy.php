<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UrlPolicy
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
        return $user->tokenCan('url:list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Url  $url
     * @return mixed
     */
    public function view(User $user, Url $url)
    {
        return $user->tokenCan('url:view') && $user->id == $url->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->tokenCan('url:upload');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Url  $url
     * @return mixed
     */
    public function delete(User $user, Url $url)
    {
        return $user->tokenCan('url:delete') && $user->id == $url->user_id;
    }
}
