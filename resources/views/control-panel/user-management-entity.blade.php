<div class="grid grid-cols-12">
    <div class="p-4 col-span-4 text-left text-sm text-gray-500">{{ $user->name }}</div>
    <div class="p-4 col-span-5 text-left text-sm text-gray-500">{{ $user->email }}</div>
    <div class="p-4 col-span-3 text-left text-sm text-gray-500">
        <div class="flex space-x-1">
            @if(!$user->is_admin)
                <button class="border-2 border-indigo-200 rounded-md p-1 focus:outline-none">
                    <!-- Heroicons: users -->
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            @else
                <button class="border-2 border-gray-200 rounded-md p-1 focus:outline-none cursor-not-allowed">
                    <!-- Heroicons: users -->
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            @endif

            <button class="border-2 border-indigo-200 rounded-md p-1 focus:outline-none">
                <!-- Heroicons: pencil -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>

            @if(!$user->is_admin)
                <button wire:click="$toggle('confirmingUserDeletion')" class="border-2 border-red-200 rounded-md p-1 focus:outline-none">
                    <!-- Heroicons: trash -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            @else
                <button class="border-2 border-gray-200 rounded-md p-1 focus:outline-none cursor-not-allowed">
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
</div>
