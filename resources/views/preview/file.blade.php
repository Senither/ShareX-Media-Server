<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ app('settings')->get('app.name') }} - Download {{ $file->original_name }}</title>
    <meta property="og:title" content="{{ $file->original_name }}">
    <meta property="og:type" content="website">
    <meta property="og:description"
          content="Download page for {{ $file->original_name }}, file size: {{ $file->formatted_size }}, file hash: {{ $file->hash_sha1 }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="h-screen flex items-center justify-center bg-gray-900 text-gray-50">

    <div class="flex flex-col">
        <div class="flex bg-gray-700 rounded-md shadow-lg overflow-hidden">
            <div class="hidden sm:block p-4">
                <img
                     class="w-32 h-32"
                     loading="lazy"
                     src="{{ asset('vendor/vscode-material-icon-theme/icons/' . $file->file_icon . '.svg') }}"
                     alt="{{ $file->original_name }}"
                     onerror="this.onerror=null; this.src='{{ asset('vendor/vscode-material-icon-theme/icons/file.svg') }}'">
            </div>

            <div class="pl-6 sm:pl-0 py-4 pr-6 z-10 justify-self-center">
                <h1 class="text-lg leading-6 font-semibold">{{ $file->original_name }}</h1>
                <div class="pt-3 flex flex-col">
                    <p class="text-gray-400 font-mono break-all">
                        <span class="text-gray-300 font-medium">File size:</span>
                        <br class="sm:hidden">
                        {{ $file->formatted_size }}
                    </p>
                    <p class="pt-3 text-gray-400 font-mono break-all">
                        <span class="text-gray-300 font-medium pr-2">MD5 Hash:</span>
                        <br class="sm:hidden">
                        {{ $file->hash_md5 }}
                    </p>
                    <p class="pt-3 sm:pt-0 text-gray-400 font-mono break-all">
                        <span class="text-gray-300 font-medium">SHA1 Hash:</span>
                        <br class="sm:hidden">
                        {{ $file->hash_sha1 }}
                    </p>
                </div>
            </div>

            <div class="relative z-0 flex items-center text-gray-600 opacity-10">
                <div class="absolute w-72 h-72 -right-12">
                    <img
                         class="transform rotate-45"
                         loading="lazy"
                         src="{{ asset('vendor/vscode-material-icon-theme/icons/' . $file->file_icon . '.svg') }}"
                         alt="{{ $file->original_name }}"
                         onerror="this.onerror=null; this.src='{{ asset('vendor/vscode-material-icon-theme/icons/file.svg') }}'">
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <div class="pt-6 flex justify-center">
                <a href="{{ route('view-file', [$file->name, 'raw']) }}"
                   class="px-4 py-2 text-lg bg-indigo-500 hover:bg-indigo-400 rounded shadow">
                    Download
                </a>
            </div>

            @if ($file->previewable)
                <div class="sm:pt-6 flex justify-center">
                    <a href="{{ $file->preview_url }}"
                       class="px-4 py-2 text-lg bg-gray-500 hover:bg-gray-400 rounded shadow">
                        Preview
                    </a>
                </div>
            @endif
        </div>
    </div>

</body>

</html>
