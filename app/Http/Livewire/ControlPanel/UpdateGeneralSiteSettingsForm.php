<?php

namespace App\Http\Livewire\ControlPanel;

use Livewire\Component;

class UpdateGeneralSiteSettingsForm extends Component
{
    /**
     * The name of the site.
     *
     * @var string
     */
    public $name;

    /**
     * The url method used to general URL strings.
     *
     * @var string
     */
    public $urlMethod;

    /**
     * The validation rules for the component.
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'min:3'],
        'urlMethod' => ['required', 'in:wordlist,characters'],
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->name = 'Some site name...';
        $this->urlMethod = 'characters';
    }

    /**
     * Update the site name.
     *
     * @return void
     */
    public function updateSiteName()
    {
        $this->validate();

        // TODO: Setup somewhere to store the site settings, and
        // save the value of the site name to that place here.

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('control-panel.update-general-site-settings-form');
    }
}
