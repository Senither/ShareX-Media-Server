@extends('preview.file')

@section('items')
    @php
    function formatZipFileName($name)
    {
        $parts = explode('/', $name);
        $file = array_pop($parts);

        if (empty($parts)) {
            return $file;
        }

        return '<span class="text-gray-500 hidden md:inline">' . join('/', $parts) . '/</span><span class="text-gray-500 md:hidden">~/</span>' . $file;
    }
    @endphp

    <div class="px-4 pb-4">
        <h2 class="px-2 text-lg leading-6 font-semibold">
            File Contents
            <span class="text-gray-400 text-base">({{ count($items) }} Files found)</span>
        </h2>

        <div class="w-full my-2 border-b border-gray-500 opacity-50"></div>

        @if (empty($items))
            <p class="px-3 text-gray-300">
                The zip file is empty, or was unable to be opened and scanned for files.
            </p>
        @else
            <div class="hidden xs:block mx-2 px-3 py-1.5 bg-gray-800 rounded shadow-md max-h-96 overflow-auto">
                @foreach ($items as $item)
                    <div class="font-mono break-words flex items-center justify-between">
                        <span>{!! formatZipFileName($item['name']) !!}</span>
                        <span class="hidden sm:inline pl-4 text-gray-400 text-sm">{{ $item['size'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="xs:hidden text-gray-400 text-center">
                Your device screen width is not supported for ZIP file previews.
            </div>
        @endif
    </div>
@endsection
