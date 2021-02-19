<?php

namespace App\Http\Livewire\ControlPanel;

use Livewire\Component;

class UpdateSiteNameForm extends Component
{
    /**
     * The name of the site.
     *
     * @var string
     */
    public $name;

    /**
     * The validation rules for the component.
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|string|min:3',
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->name = 'Some site name...';
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
        return view('control-panel.update-site-name-form');
    }
}
