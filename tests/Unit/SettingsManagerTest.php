<?php

namespace Tests\Unit;

use App\Settings\InvalidSettingsKeyException;
use App\Settings\SettingsManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SettingsManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_calling_get_returns_defaults_if_no_key_exists_in_the_database()
    {
        $this->assertEquals(app(SettingsManager::class)->get('app.name'), 'Media Server');
    }

    public function test_calling_get_returns_existing_value_if_it_exists()
    {
        DB::table('settings')->insert([
            'key' => 'app.name',
            'value' => 'Test Server',
        ]);

        $this->assertEquals(app(SettingsManager::class)->get('app.name'), 'Test Server');
    }

    public function test_callin_get_on_unsupported_key_throws_an_exception()
    {
        $this->expectException(InvalidSettingsKeyException::class);

        app(SettingsManager::class)->get('invalid.key');
    }

    public function test_setting_value_overrides_existing_value()
    {
        $manager = app(SettingsManager::class);

        $manager->set('app.name', 'Test Server');

        $this->assertEquals($manager->get('app.name'), 'Test Server');
    }

    public function test_setting_value_using_unsupported_key_throws_an_exception()
    {
        $this->expectException(InvalidSettingsKeyException::class);

        app(SettingsManager::class)->set('invalid.key', 'some value');
    }

    public function test_setting_key_to_new_value_creates_dirt()
    {
        $manager = app(SettingsManager::class);

        $manager->set('app.name', 'Test Server');

        $this->assertTrue($manager->isDirty());
    }

    public function test_setting_key_to_existing_value_doesnt_make_it_dirty()
    {
        $manager = app(SettingsManager::class);

        $manager->set('app.name', 'Media Server');

        $this->assertFalse($manager->isDirty());
    }
}
