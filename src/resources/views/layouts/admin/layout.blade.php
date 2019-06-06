<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
           <script type="text/javascript">
    function display(link) {

        if(link!=""){
    $(document.body).append('<div id="img" style="position:absolute;" ><img width="300" heigth="300" src="' + link + '" ></div>');
}
}

function move(e) {
    var x = e.clientX;
    var y = e.clientY;
    $('#img').css('top', y + 10).css("left", x - 300);
}
function del() {
    $('#img').remove();
}
</script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/behaviour.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/platformBehaviour.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/tableControls.js') }}"></script>
        <script>
            function url() {
                return '<?= url('') ?>';
            }
        </script>

        <link href="{{ asset('css/layout_platform.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/content_blocks.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/grid.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('fonts/fontawesome-free-5.3.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                @include('layouts.admin.header')
            </header>
            <main>
                @include('layouts.admin.sidebar')
                <div class="page-content" id="pageContent">
                    <div class="page-sections">
                        @yield('content')
                    </div>
                    <footer>
                        <div class="footer-content">
                        </div>
                        <div class="footer-copyright">
                        </div>
                    </footer>
                </div>
            </main>
        </div>
        <script type="text/javascript" src="{{ asset('js/sidebar_admin.js') }}"></script>
    </body>
</html>
