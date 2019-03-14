<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icon.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbars.materializeNavbar')

    <div class="progress">
        <div id="determinate" class="determinate" style="width: 0%"></div>
    </div>  

    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
            var delay = ( function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
            })();
            $(document).ajaxStart(function() {
                let determinate = document.getElementById('determinate');
                determinate.style.width = '50%'
            })
            .ajaxStop(function() {
                let determinate = document.getElementById('determinate');
                determinate.style.width = '100%'
                delay(function(){
                    // determinate.hidden = true;
                    determinate.style.width = '0%'
                }, 500)
            })
        });
    </script>
    @yield('javascript')
</body>
</html>
