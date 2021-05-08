<div class="md:grid md:grid-cols-3 md:gap-6">
    <x-jet-section-title>
        <x-slot name="title">{{ __('Manage Users') }}</x-slot>
        <x-slot name="description">
            {{ __('Manage user details, create new users, impersonate users, or delete users.') }}
        </x-slot>
    </x-jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2 px-4 py-5 bg-white dark:bg-dark-gray-700 dark:text-dark-gray-200 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
        <div class="col-span-6 flex flex-col max-w-full">
            @if (session()->has('createdUser'))
                <div class="p-4 mb-4 bg-green-200 dark:bg-green-400 text-gray-800 rounded">
                    <p>The a user for <span class="font-semibold">{{ session()->get('createdUser')['name'] }}</span>, they can sign in using their email and
                        the generated password.</p>
                    <ul class="list-inside list-disc">
                        <li><span class="font-semibold">Email:</span> {{ session()->get('createdUser')['email'] }}</li>
                        <li><span class="font-semibold">Pass:</span> {{ session()->get('createdUser')['password'] }}</li>
                    </ul>
                </div>
            @endif
            <div class="flex pb-6 space-x-2 justify-between">
                <div class="flex-1">
                    <x-jet-input id="search"
                                 type="text"
                                 class="block w-full placeholder-gray-500 focus:z-10"
                                 wire:model.500ms="search"
                                 placeholder="Search..." />
                </div>

                <x-jet-button wire:click="$set('displayingCreateNewUser', true)" class="text-xs">
                    {{ __('Create user') }}
                </x-jet-button>
            </div>

            @if ($users->isEmpty())
                <p class="text-center text-gray-700 font-medium">Found no users matching the "{{ $search }}" query.</p>
            @else
                <div class="flex flex-col w-full pb-8">
                    <div class="w-full grid grid-cols-12 bg-gray-100 dark:bg-dark-gray-800 border-b border-gray-300 dark:border-dark-gray-500">
                        <div class="p-4 col-span-4 text-left text-sm font-medium text-gray-500 dark:text-dark-gray-400">Name</div>
                        <div class="p-4 col-span-5 text-left text-sm font-medium text-gray-500 dark:text-dark-gray-400">Email</div>
                        <div class="p-4 col-span-3 text-left text-sm font-medium text-gray-500 dark:text-dark-gray-400">Actions</div>
                    </div>
                    <div class="w-full flex flex-col">
                        @foreach ($users as $user)
                            @livewire('control-panel.user-management-entity', ['user' => $user], key($user->id))
                        @endforeach
                    </div>
                </div>

                {{ $users->links() }}
            @endif
        </div>
    </div>

    <x-jet-dialog-modal wire:model="displayingCreateNewUser">
        <x-slot name="title">
            {{ __('Create User') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <p>{{ __('Enter account details for the user below.') }}</p>
                <p>{{ __('A random password will be generated for the account once its created.') }}</p>
            </div>

            <div class="pt-4">
                <x-jet-label for="userDetails_name" value="{{ __('Name') }}" />
                <x-jet-input id="userDetails_name" type="text" class="mt-1 block w-full" min="1" wire:model.defer="userDetails.name" />
                <x-jet-input-error for="userDetails.name" class="mt-2" />
            </div>

            <div class="pt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" min="1" wire:model.defer="userDetails.email" />
                <x-jet-input-error for="userDetails.email" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-2" wire:click="createNewUser" wire:loading.attr="disabled">
                {{ __('Create User') }}
            </x-jet-button>

            <x-jet-secondary-button wire:click="$set('displayingCreateNewUser', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
