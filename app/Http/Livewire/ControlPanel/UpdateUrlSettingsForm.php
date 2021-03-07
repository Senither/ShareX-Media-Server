<?php

namespace App\Http\Livewire\ControlPanel;

use Livewire\Component;

class UpdateUrlSettingsForm extends Component
{
    /**
     * The url settings.
     *
     * @var array
     */
    public $settings;

    /**
     * The validation rules for the component.
     *
     * @var array
     */
    protected $rules = [
        'settings.ttl_days' => 'required|numeric|min:0',
        'settings.ttl_hours' => 'required|numeric|min:0',
        'settings.ttl_minutes' => 'required|numeric|min:0',
        'settings.per_page' => 'required|numeric|min:1',
    ];

    /**
     * List of validation attribute names that are more human friendly.
     *
     * @var array
     */
    protected $validationAttributes = [
        'settings.ttl_days' => 'TTL days',
        'settings.ttl_hours' => 'TTL hours',
        'settings.ttl_minutes' => 'TTL minutes',
        'settings.per_page' => 'shorten URLs per page',
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $settings = app('settings');

        $this->settings = [
            'ttl_days' => $settings->get('urls.ttl_days'),
            'ttl_hours' => $settings->get('urls.ttl_hours'),
            'ttl_minutes' => $settings->get('urls.ttl_minutes'),
            'per_page' => $settings->get('urls.per_page'),
        ];
    }

    /**
     * Update the url settings.
     *
     * @return void
     */
    public function updateUrlSettings()
    {
        $this->validate();

        $manager = app('settings');

        foreach ($this->settings as $name => $value) {
            $manager->set('urls.' . $name, $value);
        }

        $this->emit('saved');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('control-panel.update-url-settings-form');
    }
}
