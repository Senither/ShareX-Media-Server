<?php

use App\User;
use App\Group;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'group_id' => Group::where('name', 'Administrator')->first()->id,
            'super'    => true,
            'username' => 'admin',
            'password' => 'secret',
            'token'    => str_random(62)
        ]);
    }
}
