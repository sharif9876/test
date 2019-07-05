<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
       
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/behaviour.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/appBehaviour.js') }}"></script>
        
        <link href="{{ asset('css/layout_app.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/containers.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('fonts/fontawesome-free-5.3.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css" >
         <script type="text/javascript">
            function url() {
                return '<?= url('') ?>';
            }
        </script>
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                @include('layouts.app.header')
            </header>
            <main>
                <div class="page-content" id="pageContent">
                    <div class="page-sections">
                        @yield('content')
                    </div>
                    <footer>
                        @include('layouts.app.footer')
                    </footer>
                </div>
            </main>
        </div>
        <script type="text/javascript" src="{{ asset('js/sidebar_app.js') }}"></script>
    </body>
</html>
