<div class="m-6 flex flex-col">
    <a class="flex-1 flex items-center" href="{{ route('view-image', $image) }}" target="blank">
        <img
            class="rounded-sm shadow-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110"
            src="{{ route('view-image', [$image, '256x256']) }}"
            alt="{{ $image->name }}"
        >
    </a>

    <div class="p-2 items-end grid grid-cols-2 text-center bg-white rounded-md border-b border-gray-200 shadow-md divide-x">
        <a class="hover:text-gray-500" href="{{ route('view-image', $image) }}" target="blank">View</a>
        <a class="text-red-500 hover:text-red-400 cursor-pointer" wire:click="delete">Delete</a>
    </div>
</div>
