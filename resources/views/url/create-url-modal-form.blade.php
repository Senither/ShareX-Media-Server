<div>
    <x-jet-button wire:click="$set('showModal', true)">
        Shorten URL
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Shorten URL') }}
        </x-slot>

        <x-slot name="content">
            @if (session()->has('upload-url'))
                <div class="pb-4">
                    <p class="pb-2">
                        The shorten URL have been generated, you can copy the link below to share it with other people.
                    </p>
                    <x-jet-input class="w-full rounded" type="text"
                                 value="{{ session('upload-url') }}"
                                 onfocus="this.select()" autofocus readonly
                                 autocomplete="off" autocorrect="off"
                                 autocapitalize="off" spellcheck="false" />
                </div>
            @endif

            <div>
                {{ __('Paste in the URl you want to be shorten below.') }}
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-input
                             class="mt-1 block w-full"
                             type="text"
                             wire:model="url"
                             placeholder="Enter the URL you want to shorten here..."
                             autofocus />

                <x-jet-input-error for="url" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if ($url)
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    {{ __('Shorten URL') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled" disabled="true">
                    {{ __('Shorten URL') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
