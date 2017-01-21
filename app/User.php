<?php

namespace App;

use App\Group;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'username', 'password', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'token'
    ];

    /**
     * Sets the route key name, allowing the controllers to type-hint
     * eloquent models to fetch users from their username.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Encrypts our password for us any time we write to the value.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Checks to see if a user has the given permission node.
     *
     * @param string  $node
     * @param boolean $strict
     * @return boolean
     */
    public function hasPermission($node, $strict = true)
    {
        if ($node == null) {
            return false;
        }

        if ($this->super == 1) {
            return true;
        }

        if (is_array($node)) {
            $permissionsCounter = 0;
            foreach ($node as $permission) {
                if (! $this->hasPermission($permission)) {
                    if ($strict) {
                        return false;
                    }
                    $permissionsCounter++;
                }
            }

            return $strict ? false : $permissionsCounter !== count($node);
        }

        if ($this->group == null) {
            $this->load('group.permissions');
        }

        return $this->group->permissions->contains('node', $node);
    }

    public function canEditUsers()
    {
        return $this->hasPermission([
            'user.edit.username',
            'user.edit.group',
            'user.edit.password'
        ], false);
    }

    /**
     * Sets up our user-group relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * Sets up our user-image relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'user_id');
    }
}
