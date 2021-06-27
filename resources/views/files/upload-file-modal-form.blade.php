<div>
    <x-jet-button wire:click="$set('showModal', true)">
        Upload File
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Upload file') }}
        </x-slot>

        <x-slot name="content">
            @if (session()->has('upload-url'))
                <div class="pb-4">
                    <p class="pb-2">
                        The file has been uploaded successfully, you can copy the link below to share the file with other people.
                    </p>
                    <x-jet-input class="w-full rounded" type="text"
                                 value="{{ session('upload-url') }}"
                                 onfocus="this.select()" autofocus readonly
                                 autocomplete="off" autocorrect="off"
                                 autocapitalize="off" spellcheck="false" />
                </div>
            @endif

            <div>
                {{ __('Select the file you want to upload.') }}
            </div>

            <div class="col-span-6 sm:col-span-4"
                 x-data="{ isUploading: false, progress: 0 }"
                 x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false"
                 x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                <input type="file" class="hidden"
                       wire:model="file"
                       x-ref="file" />

                <div class="flex items-center">
                    <x-jet-secondary-button class="mt-2 mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            x-on:click.prevent="$refs.file.click()">
                        {{ __('Select an file to upload') }}
                    </x-jet-secondary-button>
                </div>

                @if ($file)
                    <p class="py-2">{{ $file->getClientOriginalName() }}</p>
                @endif

                <div x-show="isUploading" class="pt-4 opacity-75">
                    <div class="w-96 h-3 bg-indigo-200 dark:bg-dark-gray-500 rounded shadow">
                        <div class="h-3 bg-indigo-500 rounded" :style="['width: ' + progress + '%']"></div>
                    </div>
                </div>

                <x-jet-input-error for="file" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if ($file)
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save File') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled" disabled="true">
                    {{ __('Save File') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
