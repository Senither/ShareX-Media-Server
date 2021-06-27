<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Control Panel') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('control-panel.update-general-site-settings-form')

            <x-jet-section-border />

            <div x-data="{ active: 'image' }">
                <div class="pt-8 sm:pt-0 pb-8 text-center font-semibold text-gray-100">
                    <h4 class="text-lg font-medium text-gray-900 dark:text-dark-gray-100">
                        Media Settings Type
                    </h4>
                    <p class="pb-4 text-sm text-gray-600 dark:text-dark-gray-400">
                        Select the type of media resource you want the change the settings for.
                    </p>

                    <a
                       x-on:click="active = 'image'"
                       :class="{
                            'underline bg-gray-800 dark:bg-dark-gray-700': active == 'image',
                            'bg-gray-700 dark:bg-dark-gray-800 hover:bg-gray-500 dark:hover:bg-dark-gray-600': active != 'image'
                        }"
                       class="px-3 py-1.5 mx-2 rounded dark:bg-dark-gray-800 text-sm cursor-pointer text-white dark:text-dark-gray-400">
                        Images
                    </a>
                    <a
                       x-on:click="active = 'text'"
                       :class="{
                            'underline bg-gray-800 dark:bg-dark-gray-700': active == 'text',
                            'bg-gray-700 dark:bg-dark-gray-800 hover:bg-gray-500 dark:hover:bg-dark-gray-600': active != 'text'
                        }"
                       class="px-3 py-1.5 mx-2 rounded dark:bg-dark-gray-800 text-sm cursor-pointer text-white dark:text-dark-gray-400">
                        Texts
                    </a>
                    <a
                       x-on:click="active = 'url'"
                       :class="{
                            'underline bg-gray-800 dark:bg-dark-gray-700': active == 'url',
                            'bg-gray-700 dark:bg-dark-gray-800 hover:bg-gray-500 dark:hover:bg-dark-gray-600': active != 'url'
                        }"
                       class="px-3 py-1.5 mx-2 rounded dark:bg-dark-gray-800 text-sm cursor-pointer text-white dark:text-dark-gray-400">
                        URLs
                    </a>
                    <a
                       x-on:click="active = 'file'"
                       :class="{
                            'underline bg-gray-800 dark:bg-dark-gray-700': active == 'file',
                            'bg-gray-700 dark:bg-dark-gray-800 hover:bg-gray-500 dark:hover:bg-dark-gray-600': active != 'file'
                        }"
                       class="px-3 py-1.5 mx-2 rounded dark:bg-dark-gray-800 text-sm cursor-pointer text-white dark:text-dark-gray-400">
                        Files
                    </a>
                </div>

                <div x-show="active == 'image'" class="mt-10 sm:mt-0">
                    @livewire('control-panel.update-image-settings-form')
                </div>

                <div x-show="active == 'text'" class="mt-10 sm:mt-0">
                    @livewire('control-panel.update-text-settings-form')
                </div>

                <div x-show="active == 'url'" class="mt-10 sm:mt-0">
                    @livewire('control-panel.update-url-settings-form')
                </div>

                <div x-show="active == 'file'" class="mt-10 sm:mt-0">
                    @livewire('control-panel.update-file-settings-form')
                </div>
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('control-panel.user-management-list')
            </div>
        </div>
    </div>
</x-app-layout>
