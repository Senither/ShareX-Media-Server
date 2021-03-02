<div class="grid grid-cols-12">
    <div class="p-4 col-span-4 text-left text-sm text-gray-500 dark:text-dark-gray-300">{{ $user->name }}</div>
    <div class="p-4 col-span-5 text-left text-sm text-gray-500 dark:text-dark-gray-300">{{ $user->email }}</div>
    <div class="p-4 col-span-3 text-left text-sm text-gray-500 dark:text-dark-gray-300">
        <div class="flex space-x-1">
            @if(!$user->is_admin)
                <button wire:click="impersonateUser" class="border-2 border-indigo-200 dark:border-dark-gray-800 rounded-md p-1 focus:outline-none">
                    <!-- Heroicons: users -->
                    <svg class="h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            @else
                <button class="border-2 border-gray-200 dark:border-dark-gray-600 rounded-md p-1 focus:outline-none cursor-not-allowed">
                    <!-- Heroicons: users -->
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            @endif

            <button wire:click="$toggle('confirmingUserEditing')" class="border-2 border-indigo-200 dark:border-dark-gray-800 rounded-md p-1 focus:outline-none">
                <!-- Heroicons: pencil -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>

            @if(!$user->is_admin)
                <button wire:click="$toggle('confirmingUserDeletion')" class="border-2 border-red-200 dark:border-dark-gray-800 rounded-md p-1 focus:outline-none">
                    <!-- Heroicons: trash -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            @else
                <button class="border-2 border-gray-200 dark:border-dark-gray-600 rounded-md p-1 focus:outline-none cursor-not-allowed">
                    <!-- Heroicons: trash -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <!-- Delete user modal -->
    <x-jet-dialog-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('You\'re about to user account belonging to :name, this will also delete all their uploaded images, files, and text snippets.', [
                    'name' => $user->name
                ]) }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Edit user modal -->
    <x-jet-dialog-modal wire:model="confirmingUserEditing">
        <x-slot name="title">
            {{ __('Update :name', ['name' => $user->name]) }}
        </x-slot>

        <x-slot name="content">
            <div>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="user_name_{{ $user->id }}" value="{{ __('Name') }}" />
                    <x-jet-input id="user_name_{{ $user->id }}" type="text" class="mt-1 block w-full" wire:model.defer="userForm.name" />
                    <x-jet-input-error for="userForm.name" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4 col-span-6 sm:col-span-4">
                    <x-jet-label for="user_email_{{ $user->id }}" value="{{ __('Email') }}" />
                    <x-jet-input id="user_email_{{ $user->id }}" type="email" class="mt-1 block w-full" wire:model.defer="userForm.email" />
                    <x-jet-input-error for="userForm.email" class="mt-2" />
                </div>

                <!-- New password -->
                <div class="mt-4 col-span-6 sm:col-span-4">
                    <x-jet-label for="user_password_{{ $user->id }}" value="{{ __('New Password') }}" />
                    <x-jet-input id="user_password_{{ $user->id }}" type="password" class="mt-1 block w-full" wire:model.defer="userForm.password" />
                    <x-jet-input-error for="userForm.password" class="mt-2" />
                </div>

                <div class="mt-4 p-2 flex items-center bg-gray-800 dark:bg-dark-gray-800 text-sm text-gray-100 rounded">
                    <svg class="w-6 h-6 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>If the password option is left blank, the users password will not be updated.</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserEditing')" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

                <div class="flex items-center">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>

                    <x-jet-button class="ml-2" wire:click="updateUser" wire:loading.attr="disabled">
                        {{ __('Save Changes') }}
                    </x-jet-button>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
