<div>
    <x-jet-button wire:click="$set('showModal', true)">
        Upload Image
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Upload image') }}
        </x-slot>

        <x-slot name="content">
            @if (session()->has('upload-url'))
                <div class="pb-4">
                    <p class="pb-2">
                        The image has been uploaded successfully, you can copy the link below to share the image with other people.
                    </p>
                    <x-jet-input class="w-full rounded" type="text"
                                 value="{{ session('upload-url') }}"
                                 onfocus="this.select()" autofocus readonly
                                 autocomplete="off" autocorrect="off"
                                 autocapitalize="off" spellcheck="false" />
                </div>
            @endif

            <div>
                {{ __('Select the image you want to upload.') }}
            </div>

            <div class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden"
                       wire:model="image"
                       x-ref="image" />

                @if ($image)
                    <div class="mt-2">
                        <img
                             class="block h-48 rounded"
                             src="{{ $image->temporaryUrl() }}" />
                    </div>
                @endif

                <div class="flex items-center">
                    <x-jet-secondary-button class="mt-2 mr-2"
                                            type="button"
                                            wire:loading.attr="disabled"
                                            x-on:click.prevent="$refs.image.click()">
                        {{ __('Select an image to upload') }}
                    </x-jet-secondary-button>

                    <div class="font-medium opacity-75" wire:loading wire:target="image">Uploading...</div>
                </div>

                <x-jet-input-error for="image" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if ($image)
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save Image') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled" disabled="true">
                    {{ __('Save Image') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
