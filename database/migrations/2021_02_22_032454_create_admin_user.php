<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUser extends Migration
{
    public function up()
    {
        $user = User::create([
            'name' => 'Site Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user->is_admin = true;

        $user->save();
    }
}
