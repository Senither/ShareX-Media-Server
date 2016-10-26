<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
