<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ app('settings')->get('app.name') }} - {{ $text->original_name }}</title>
    <meta property="og:title" content="{{ $text->original_name }}">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ $metaDescription }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/styles/default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/styles/atom-one-dark.min.css"
          integrity="sha512-Fcqyubi5qOvl+yCwSJ+r7lli+CO1eHXMaugsZrnxuU4DVpLYWXTVoHy55+mCb4VZpMgy7PBhV7IiymC0yu9tkQ==" crossorigin="anonymous" />
    <style type="text/css">
        .hljs-ln-n {
            width: 2.5rem;
        }

    </style>

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/highlight.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block)
                hljs.lineNumbersBlock(block)
            })
        })

    </script>
</head>

<body style="background-color: #282C34">
    @livewire('preview.text-information', [$text])

    <div class="font-sans antialiased">
        <div class="px-2">
            <pre><code class="h-screen {{ $text->extension }}">{{ $text->content }}</code></pre>
        </div>
    </div>

    @livewireScripts
</body>

</html>
