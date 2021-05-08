<div>
    <x-jet-button wire:click="$set('showModal', true)">
        Upload Text
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Upload text snippet') }}
        </x-slot>

        <x-slot name="content">
            @if (session()->has('upload-url'))
                <div class="pb-4">
                    <p class="pb-2">
                        The text file has been created successfully, you can copy the link below to share the file with other people.
                    </p>
                    <x-jet-input class="w-full rounded" type="text"
                                 value="{{ session('upload-url') }}"
                                 onfocus="this.select()" autofocus readonly
                                 autocomplete="off" autocorrect="off"
                                 autocapitalize="off" spellcheck="false" />
                </div>
            @endif

            <div>
                {{ __('Enter the text you want to save below.') }}
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-input class="w-full rounded" type="text"
                             wire:model="name"
                             placeholder="Enter the name of the file here..." />

                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <textarea
                          class="dark:text-dark-gray-200 border-gray-300 dark:border-dark-gray-600 focus:border-indigo-300 dark:focus:border-dark-gray-600 focus:ring-1 dark:focus:ring-dark-gray-800 dark:bg-dark-gray-800 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                          wire:model="text"
                          rows="6"
                          placeholder="Enter the contents of the text snippet here..."></textarea>

                <x-jet-input-error for="text" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden"
                       wire:model="file"
                       x-ref="file" />

                <div class="flex items-center">
                    <x-jet-secondary-button
                                            class="mt-2 mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            x-on:click.prevent="$refs.file.click()">
                        {{ __('or upload a text file') }}
                    </x-jet-secondary-button>

                    <div class="font-medium opacity-75" wire:loading wire:target="file">Uploading...</div>
                </div>

                <x-jet-input-error for="file" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if ($name && $text)
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save Text') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled" disabled="true">
                    {{ __('Save Text') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
