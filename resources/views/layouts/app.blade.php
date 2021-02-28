<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ app('settings')->get('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="flex flex-col min-h-screen justify-between bg-gray-100">
            @if(request()->user()->isImposter())
                <div class="w-full bg-gray-900 text-center">
                    <p class="p-3 text-sm text-gray-200">
                        You're currently viewing the site as
                        <span class="font-bold text-indigo-200">{{ request()->user()->name }}</span>,
                        you can <a
                            href="{{ route('imposter.leave') }}"
                            class="text-indigo-400 cursor-pointer hover:text-indigo-300 hover:underline"
                        >click here</a> to return to your own account.
                    </p>
                </div>
            @endif

            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mb-auto">
                {{ $slot }}
            </main>

            <footer class="mt-12 bg-white shadow">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-gray-600">
                    <p class="font-semibold">
                        ShareX Media Server
                    </p>
                    <p class="text-sm">
                        Created by <a class="text-indigo-600 hover:text-indigo-400 font-semibold" href="https://senither.com/">Alexis Tan</a>,
                        powered by <a class="text-indigo-600 hover:text-indigo-400 font-semibold" href="https://laravel.com/">Laravel</a>,
                        <a class="text-indigo-600 hover:text-indigo-400 font-semibold" href="https://laravel-livewire.com/">Livewire</a>,
                        and <a class="text-indigo-600 hover:text-indigo-400 font-semibold" href="https://tailwindcss.com/">TailwindCSS</a>.
                    </p>
                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
