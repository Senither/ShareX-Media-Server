<div class="md:grid md:grid-cols-3 md:gap-6">
    <x-jet-section-title>
        <x-slot name="title">{{ __('Manage Users') }}</x-slot>
        <x-slot name="description">
            {{ __('Manage user details, create new users, impersonate users, or delete users.') }}
        </x-slot>
    </x-jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2 px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
        <div class="col-span-6 flex flex-col max-w-full">
            @if(session()->has('createdUser'))
                <div class="p-4 mb-4 bg-green-200 text-gray-800 rounded">
                    <p>The a user for <span class="font-semibold">{{ session()->get('createdUser')['name'] }}</span>, they can sign in using their email and the generated password.</p>
                    <ul class="list-inside list-disc">
                        <li><span class="font-semibold">Email:</span> {{ session()->get('createdUser')['email'] }}</li>
                        <li><span class="font-semibold">Pass:</span> {{ session()->get('createdUser')['password'] }}</li>
                    </ul>
                </div>
            @endif
            <div class="flex pb-6 space-x-2 justify-between">
                <div class="flex-1">
                    <x-jet-input
                        id="search"
                        type="text"
                        class="block w-full placeholder-gray-500 focus:z-10"
                        wire:model.500ms="search"
                        placeholder="Search..."
                    />
                </div>

                <x-jet-button wire:click="$set('displayingCreateNewUser', true)" class="text-xs">
                    {{ __('Create user') }}
                </x-jet-button>
            </div>

            @if($users->isEmpty())
                <p class="text-center text-gray-700 font-medium">Found no users matching the "{{ $search }}" query.</p>
            @else
                <table class="overflow-x-auto w-full bg-white">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Name</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Email</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                        @foreach ($users as $user)
                            <tr class="bg-white font-medium text-sm divide-y divide-gray-200">
                                <td class="p-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex space-x-1">
                                        <button class="border-2 border-indigo-200 rounded-md p-1 focus:outline-none">
                                            <!-- Heroicons: users -->
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                        </button>

                                        <button class="border-2 border-indigo-200 rounded-md p-1 focus:outline-none">
                                            <!-- Heroicons: pencil -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <button class="border-2 border-red-200 rounded-md p-1 focus:outline-none">
                                            <!-- Heroicons: trash -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pt-4">
                    {{ $users->links() }}
                </div>
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
                <x-jet-label for="per_page" value="{{ __('Name') }}" />
                <x-jet-input id="per_page" type="text" class="mt-1 block w-full" min="1" wire:model.defer="userDetails.name" />
                <x-jet-input-error for="userDetails.name" class="mt-2" />
            </div>

            <div class="pt-4">
                <x-jet-label for="per_page" value="{{ __('Email') }}" />
                <x-jet-input id="per_page" type="text" class="mt-1 block w-full" min="1" wire:model.defer="userDetails.email" />
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
