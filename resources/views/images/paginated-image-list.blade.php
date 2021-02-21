<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
            @if($images->isEmpty())
                <p class="p-8 col-span-6 text-center">
                    You don't have any image uploads right now, create an <a class="text-indigo-700" href="{{ route('api-tokens.index') }}">API token</a> to start uploading images.
                </p>
            @else
                @foreach($images as $image)
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
                            <a class="text-red-500 hover:text-red-400" href="#">Delete</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        @if($images->hasPages())
            <div class="p-4 bg-gray-50 border-t">
                {{ $images->links() }}
            </div>
        @endif
    </div>
</div>
