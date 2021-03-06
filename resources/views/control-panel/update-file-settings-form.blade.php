<x-jet-form-section submit="updateFileSettings">
    <x-slot name="title">
        {{ __('File Settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change how file are handled and displayed on the site.') }}
    </x-slot>

    <x-slot name="form">
        <!-- TTL -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="file_ttl_days" value="{{ __('File Live Time (Days, Hours and Minutes)') }}" />
            <div class="flex space-x-3">
                <x-jet-input id="file_ttl_days" type="number" class="mt-1 block w-full" min="0" wire:model.defer="settings.ttl_days" />
                <x-jet-input id="file_ttl_hours" type="number" class="mt-1 block w-full" min="0" wire:model.defer="settings.ttl_hours" />
                <x-jet-input id="file_ttl_minutes" type="number" class="mt-1 block w-full" min="0" wire:model.defer="settings.ttl_minutes" />
            </div>
            <x-jet-input-error for="settings.ttl_days" class="mt-2" />
            <x-jet-input-error for="settings.ttl_hours" class="mt-2" />
            <x-jet-input-error for="settings.ttl_minutes" class="mt-2" />
        </div>

        <!-- Per page -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="file_per_page" value="{{ __('Files per page') }}" />
            <x-jet-input id="file_per_page" type="number" class="mt-1 block w-full" min="1" wire:model.defer="settings.per_page" />
            <x-jet-input-error for="settings.per_page" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
