<x-jet-action-section id="theme-switcher">
    <x-slot name="title">
        {{ __('Site Theme Preferences') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change the look of the site when you\'re signed in.') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-dark-gray-100">
            @if(request()->user()->theme == null)
                <blockquote class="px-3 py-2 mb-4 bg-gray-300 dark:bg-dark-gray-800 border-l-4 border-gray-500 dark:border-dark-gray-500">
                    {{ __('The default theme is selected, this means that the theme can be changed. via the application control panel.') }}
                </blockquote>
            @endif

            <p>
                {{ __("You're currently viewing the site in :theme mode, you can use the button below to change your prefered site theme.", [
                    'theme' => $theme
                ]) }}
            </p>

            <x-jet-button class="mt-4" wire:click="changeTheme('{{ $theme == 'dark' ? 'light' : 'dark' }}')">
                Change to {{ $theme == 'dark' ? 'light' : 'dark' }} theme
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-action-section>
