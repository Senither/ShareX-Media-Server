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
     * The list of domains that can be used to access file uploads.
     *
     * @var array
     */
    public $domains;

    /**
     * The current site theme.
     *
     * @var string
     */
    public $theme;

    /**
     * The validation rules for the component.
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'min:3'],
        'urlMethod' => ['required', 'in:wordlist,characters'],
        'domains' => ['array'],
        'domains.*' => ['nullable', 'url'],
        'theme' => ['required', 'string', 'in:light,dark'],
    ];

    /**
     * List of validation attribute names that are more human friendly.
     *
     * @var array
     */
    protected $validationAttributes = [
        'domains.*' => 'domain',
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $settings = app('settings');

        $this->name = $settings->get('app.name');
        $this->urlMethod = $settings->get('app.url_generator');
        $this->domains = $settings->get('app.domains');
        $this->theme = $settings->get('app.theme');
    }

    /**
     * Add a new empty string to the domains list.
     *
     * @return void
     */
    public function incrementDomains()
    {
        $this->domains[] .= '';
    }

    /**
     * Remove the domain entry with the given key.
     *
     * @param  int $key
     * @return void
     */
    public function removeDomain($key)
    {
        unset($this->domains[$key]);
    }

    /**
     * Update the site settings.
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update()
    {
        $this->validate();

        $this->domains = collect($this->domains)
            ->filter(function ($domain) {
                return mb_strlen(trim($domain)) > 0;
            })
            ->map(function ($domain) {
                return rtrim($domain, '/');
            })
            ->toArray();

        $manager = app('settings');

        $wasThemeChanged = $this->theme != $manager->get('app.theme');

        $manager->set('app.name', $this->name);
        $manager->set('app.url_generator', $this->urlMethod);
        $manager->set('app.domains', $this->domains);
        $manager->set('app.theme', $this->theme);

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');

        if ($wasThemeChanged) {
            return redirect()->route('control-panel');
        }
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
