<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ app('settings')->get('app.name') }} - {{ $text->original_name }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.6.0/styles/atom-one-dark.min.css" integrity="sha512-Fcqyubi5qOvl+yCwSJ+r7lli+CO1eHXMaugsZrnxuU4DVpLYWXTVoHy55+mCb4VZpMgy7PBhV7IiymC0yu9tkQ==" crossorigin="anonymous" />
        <style type="text/css">
            .hljs-ln-n {
                width: 2.5rem;
            }
        </style>

        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
            hljs.initLineNumbersOnLoad();
        </script>
    </head>
    <body style="background-color: #282C34">
        <div class="font-sans antialiased">
            <div class="p-2">
                <pre><code class="{{ $text->extension }}">{{ $text->content }}</code></pre>
            </div>
        </div>
    </body>
</html>
