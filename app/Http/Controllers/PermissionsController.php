<?php

namespace App\Http\Controllers;

use App\Group;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function show(Group $group)
    {
        $this->prepareGroupPermissions($group);
        $permissions = Permission::orderBy('node')->get();

        return view('permissions.show', compact('group', 'permissions'));
    }

    public function update(Group $group)
    {
        $this->prepareGroupPermissions($group);
        $permission = $this->preparePermission();

        if ($permission != null) {
            $group->permissions()->toggle($permission->id);
        }

        return redirect()->action('PermissionsController@show', [mb_strtolower($group->name)]);
    }

    protected function prepareGroupPermissions(Group $group)
    {
        if (! Auth::user()->super) {
            abort(401);
        }

        return $group->load('permissions');
    }

    protected function preparePermission()
    {
        foreach (request()->all() as $name => $_) {
            if (starts_with($name, 'permission-')) {
                return Permission::findOrFail(mb_substr($name, 11));
            }
        }

        return null;
    }
}
