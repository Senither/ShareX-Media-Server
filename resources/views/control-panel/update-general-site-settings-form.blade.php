<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('General Site Settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change the general global site settings.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('URL Generation Method') }}" />
            <select
                wire:model="urlMethod"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
                <option value="wordlist">Word List</option>
                <option value="characters">Random Characters</option>
            </select>
            <x-jet-input-error for="urlMethod" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="domains_0" value="{{ __('URL Domains') }}" />

            @if(empty($domains))
                <p class="px-4 py-2 text-sm text-center">
                    No domains have been added.<br class="block sm:hidden">Click on the <span class="italic">"Add Domain"</span> button to add your first domain.
                </p>
            @else
                @foreach ($domains as $key => $domain)
                    <div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-8 sm:text-sm border-gray-300 rounded-md"
                                id="domains_{{ $key }}"
                                type="text"
                                wire:model.defer="domains.{{ $key }}"
                                placeholder="Enter a domain name here..."
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <button
                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-3 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                    wire:click.prevent="removeDomain({{ $key }})"
                                >
                                    X
                                </button>
                            </div>
                        </div>
                    </div>
                    <x-jet-input-error for="domains.{{ $key }}" class="mt-2" />
                @endforeach
            @endif

            <div class="w-full mt-4 flex items-center text-sm">
                <div class="w-full mr-4">
                    <x-jet-button
                        type="incrementDomains"
                        wire:loading.attr="disabled"
                        wire:click.prevent="incrementDomains"
                    >
                        {{ __('Add Domain') }}
                    </x-jet-button>
                </div>

                <p>The domains are selected at random when uploading files to the media server, allowing the resource links to be generated using any number of domain names.</p>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
