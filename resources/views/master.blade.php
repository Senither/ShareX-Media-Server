<!DOCTYPE html>
<html>
<head>
    <title>{{ $settings->name }} &bull; @yield('page-title')</title>
    <link rel="stylesheet" href="{{ asset('static/app.css') }}">
</head>
<body>
<div class="container">
    @include('partial.header')

    @yield('content')

    <div class="row">
        <div class="col-md-12 flex-center">
            <p class="footer-note">Created by <a href="http://senither.com/">Alexis Tan</a> with <span>&hearts;</span> using <a href="https://laravel.com/">Laravel</a> &amp; <a href="http://getbootstrap.com/">Bootstrap</a>.</p>
        </div>
    </div>
</div>
<script src="{{ asset('static/app.js') }}"></script>
@yield('script')
</body>
</html>