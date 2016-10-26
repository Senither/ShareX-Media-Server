<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'node'];

    /**
     * Turn off timestamps for the permissions table.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the groups associated with the given permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function group()
    {
        return $this->belongsToMany(Group::class, 'groups_permissions');
    }
}
