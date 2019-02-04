<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/behaviour.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/guestBehaviour.js') }}"></script>

        <link href="{{ asset('css/layout_guest.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/blocks.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('fonts/fontawesome-free-5.3.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                @include('layouts.guest.header')
            </header>
            <main>
                <div class="page-content" id="pageContent">
                    <div class="page-sections">
                        @yield('content')
                    </div>
                    <footer>
                        @include('layouts.guest.footer')
                    </footer>
                </div>
            </main>
        </div>
        <script type="text/javascript" src="{{ asset('js/sidebar_guest.js') }}"></script>
    </body>
</html>
