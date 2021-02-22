<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::factory()
            ->siteAdmin()
            ->create([
                'name' => 'Site Administrator',
                'email' => 'admin@admin.com',
            ]);
    }
}
