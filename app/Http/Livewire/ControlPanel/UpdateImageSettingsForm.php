<?php

namespace App\Http\Livewire\ControlPanel;

use Livewire\Component;

class UpdateImageSettingsForm extends Component
{
    /**
     * The image settings.
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
        'settings.per_page' => 'images per page',
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->settings = [
            'ttl_days' => 90,
            'ttl_hours' => 0,
            'ttl_minutes' => 0,
            'per_page' => 24,
        ];
    }

    /**
     * Update the image settings.
     *
     * @return void
     */
    public function updateImageSettings()
    {
        $this->validate();

        // TODO: Setup somewhere to store the site settings, and
        // save the value of the site name to that place here.

        $this->emit('saved');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('control-panel.update-image-settings-form');
    }
}
