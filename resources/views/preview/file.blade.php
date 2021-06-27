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
        <div class="flex bg-gray-700 rounded-md shadow-lg">
            <div class="p-4">
                <img
                     class="w-32 h-32"
                     loading="lazy"
                     src="{{ asset('vendor/vscode-material-icon-theme/icons/' . $file->file_icon . '.svg') }}"
                     alt="{{ $file->original_name }}"
                     onerror="this.onerror=null; this.src='{{ asset('vendor/vscode-material-icon-theme/icons/file.svg') }}'">
            </div>
            <div class="py-4 pr-6 justify-self-center">
                <h1 class="text-lg leading-6 font-semibold">{{ $file->original_name }}</h1>
                <div class="pt-3 flex flex-col">
                    <p class="text-gray-400 font-mono">
                        <span class="text-gray-300 font-medium">File size:</span>
                        {{ $file->formatted_size }}
                    </p>
                    <p class="pt-3 text-gray-400 font-mono">
                        <span class="text-gray-300 font-medium pr-2">MD5 Hash:</span>
                        {{ $file->hash_md5 }}
                    </p>
                    <p class="text-gray-400 font-mono">
                        <span class="text-gray-300 font-medium">SHA1 Hash:</span>
                        {{ $file->hash_sha1 }}
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-center">
            <a href="{{ route('view-file', [$file->name, 'raw']) }}"
               class="px-4 py-2 text-lg bg-indigo-500 hover:bg-indigo-400 rounded shadow">
                Download {{ $file->original_name }}
            </a>
        </div>
    </div>

</body>

</html>
