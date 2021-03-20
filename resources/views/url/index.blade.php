<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Your shorten URLs') }}
            </h2>

            @livewire('url.create-url-modal-form')
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('url.paginated-url-list')
        </div>
    </div>
</x-app-layout>
