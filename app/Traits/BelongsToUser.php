<?php

namespace App\Traits;

use App\Scopes\UserScope;

trait BelongsToUser
{
    /**
     * Boot the belongs to team trait for a model.
     *
     * @return void
     */
    public static function bootBelongsToUser()
    {
        static::addGlobalScope(new UserScope());
    }
}
