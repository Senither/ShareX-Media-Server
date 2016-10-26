<?php

use App\Group;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    protected $permissions = [
        [
            'name' => 'Allows the user to see the user management panel',
            'node' => 'user.management.see'
        ], [
            'name' => 'Allows the user to create new users',
            'node' => 'user.create'
        ], [
            'name' => 'Allows the user to see the settings panel',
            'node' => 'settings.see',
        ], [
            'name' => 'Allows the user to update the site settings',
            'node' => 'settings.update',
        ], [
            'name' => 'Allows the user to create a new user with a group of ID 2',
            'node' => 'user.create.group.2'
        ], [
            'name' => 'Allows the user to create a new user with a group of ID 3',
            'node' => 'user.create.group.3'
        ], [
            'name' => 'Allows the user to edit other uses with a group ID of 2',
            'node' => 'user.edit.group.2'
        ], [
            'name' => 'Allows the user to edit other uses groups',
            'node' => 'user.edit.group'
        ], [
            'name' => 'Allows the user to edit other uses with a group ID of 3',
            'node' => 'user.edit.group.3'
        ], [
            'name' => 'Allows the user to change other peoples usernames',
            'node' => 'user.edit.username'
        ], [
            'name' => 'Allows the user to change other peoples passwords',
            'node' => 'user.edit.password'
        ], [
            'name' => 'Allows to user to delete their own images',
            'node' => 'user.image.delete'
        ], [
            'name' => 'Allows to user to delete other peoples images',
            'node' => 'user.image.delete.others'
        ], [
            'name' => 'Allows to user to see other peoples images',
            'node' => 'user.image.see'
        ]
    ];

    protected $administrator = [
        'group' => 'Administrator',
        'nodes' => [
            'user.management.see',
            'user.create',
            'settings.see',
            'settings.update',
            'user.create.group.2',
            'user.create.group.3',
            'user.edit.group.2',
            'user.edit.group',
            'user.edit.group.3',
            'user.edit.username',
            'user.edit.password',
            'user.image.delete',
            'user.image.delete.others',
            'user.image.see',
        ]
    ];

    protected $moderator = [
        'group' => 'Moderator',
        'nodes' => [
            'user.management.see',
            'user.create',
            'user.create.group.3',
            'user.edit.group.3',
            'user.edit.password',
            'user.image.see',
            'user.image.delete',
        ]
    ];

    protected $user = [
        'group' => 'User',
        'nodes' => [
            'user.image.delete',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('groups_permissions')->truncate();

        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }

        foreach ($this->buildPermissionsMap() as $permission) {
            $group = $permission['group'];
            
            foreach ($permission['nodes'] as $node) {
                $permission = Permission::where('node', $node)->first();
                
                if ($permission == null) {
                    continue;
                }
            
                $permission->group()->attach($group);
            }
        }
    }

    /**
     * Builds the permission map and gets the eloquent group model
     * instance for the group linked to the permissions map.
     *
     * @param  array  $permissions
     * @return array
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    protected function buildPermissionsMap($permissions = [])
    {
        foreach (get_class_vars(__CLASS__) as $property) {
            if (! is_array($property) || ! isset($property['group'], $property['nodes'])) {
                continue;
            }

            $property['group'] = Group::where('name', $property['group'])->firstOrFail();
            $permissions[]     = $property;
        }

        return $permissions;
    }
}
