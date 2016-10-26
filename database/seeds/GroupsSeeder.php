<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'Administrator',
            'color' => 'd9534f'
        ]);

        Group::create([
            'name' => 'Moderator',
            'color' => '5CB849'
        ]);

        Group::create([
            'name' => 'User'
        ]);
    }
}
