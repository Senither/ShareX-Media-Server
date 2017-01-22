<?php

namespace App;

use App\User;
use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Sets the route key name, allowing the controllers to type-hint
     * eloquent models to fetch users from their username.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /*
     * Sets up our group-to-users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'groups_id', 'id');
    }

    /**
     * Get the permissions associated with the given permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'groups_permissions');
    }
}
