<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ThemeSwitcherForm extends Component
{
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
        'theme' => ['required', 'string', 'in:light,dark'],
    ];

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $settings = app('settings');

        $this->theme = isUsingDarkMode() ? 'dark' : 'light';
    }

    /**
     * Change the theme for the authenticated user to the given theme.
     *
     * @param  string $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeTheme($theme)
    {
        request()
            ->user()
            ->update(compact('theme'));

        return redirect()->route('profile.show');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.theme-switcher-form');
    }
}
