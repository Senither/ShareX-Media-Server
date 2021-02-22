<?php

namespace App\Settings;

use App\Settings\InvalidSettingsKeyException;
use Illuminate\Support\Facades\DB;

class SettingsManager
{
    /**
     * A list of the default settings values, as-well-as
     * all the settings that are supported.
     *
     * @var array
     */
    protected $settings = [
        'app.name' => 'Media Server',
        'app.url_generator' => 'characters',
        'images.ttl_days' => 90,
        'images.ttl_hours' => 0,
        'images.ttl_minutes' => 0,
        'images.per_page' => 24,
    ];

    /**
     * A list of dirty settings, where the key is the name of the
     * setting, and the value is the settings new value.
     *
     * @var array
     */
    protected $dirty = [];

    /**
     * A list of settings keys that already exists in the database.
     *
     * @var array
     */
    protected $existingKeys = [];

    /**
     * Determines if the settings has been loaded from the database yet or not.
     *
     * @var boolean
     */
    protected $hasLoadedDatabase = false;

    /**
     * Syncs any changes with the database that was made.
     */
    public function __destruct()
    {
        if (!empty($this->dirty)) {
            $this->syncDirtWithDatabase();
        }
    }

    /**
     * Gets the settings value with the given name, if no setting option
     * exists with the given name the InvalidSettingsKeyException will
     * be thrown instead.
     *
     * @param  string $name
     * @return mixed
     *
     * @throws \App\Settings\InvalidSettingsKeyException
     */
    public function get(string $name)
    {
        $this->ensureSettingsAreLoaded();

        if (!$this->exists($name)) {
            throw new InvalidSettingsKeyException($name);
        }

        return $this->settings[$name];
    }

    /**
     * Sets a settings name to the given value, if "updateOnChanges" is false
     * the database won't save the setting change to the database.
     *
     * @param string  $name
     * @param mixed  $value
     * @param boolean $updateOnChanges
     *
     * @throws \App\Settings\InvalidSettingsKeyException
     */
    public function set($name, $value, $updateOnChanges = true)
    {
        $this->ensureSettingsAreLoaded();

        if (!$this->exists($name)) {
            throw new InvalidSettingsKeyException($name);
        }

        if ($updateOnChanges && $this->settings[$name] != $value) {
            $this->dirty[$name] = $value;
        }

        $this->settings[$name] = $value;
    }

    /**
     * Checks if the settings exists with the given name.
     *
     * @param  string $name
     * @return bool
     */
    public function exists(string $name): bool
    {
        return array_key_exists($name, $this->settings);
    }

    /**
     * Checks if the settings have been loaded from the database yet, if they
     * haven't the method will load all the settings in the database, and
     * store their keys in an array so we can check for them later
     *
     * @return void
     */
    public function ensureSettingsAreLoaded()
    {
        if ($this->hasLoadedDatabase) {
            return;
        }

        $this->existingKeys = [];

        foreach (DB::table('settings')->get() as $setting) {
            $this->set($setting->key, $setting->value, false);

            $this->existingKeys[] .= $setting->key;
        }

        $this->hasLoadedDatabase = true;
    }

    /**
     * Syncs the dirty settings with the database.
     *
     * @return void
     */
    protected function syncDirtWithDatabase()
    {
        foreach ($this->dirty as $key => $value) {
            if (!in_array($key, $this->existingKeys)) {
                DB::table('settings')->insert(compact('key', 'value'));
            } else {
                DB::table('settings')
                    ->where('key', $key)
                    ->update(compact('value'));
            }
        }
    }
}
