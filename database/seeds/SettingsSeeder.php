<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        $settings = new Settings();

        $settings->name        = 'Your Media Server';
        $settings->per_page    = 24;
        $settings->live_day    = 7;
        $settings->live_hour   = 0;
        $settings->live_minute = 0;

        $settings->save();
    }
}
