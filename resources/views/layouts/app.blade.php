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
    <style>
        input[type='number'] {
            -moz-appearance:textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
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
        let datePickerInit = () => {
            let datepicker = document.querySelector('.datepicker');
            let datepickerInstances = M.Datepicker.init(datepicker, {
                firstDay: true, 
                format: 'yyyy-mm-dd',
                i18n: {
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                    weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
                }
            });
            datepickerInstances.open();
        }
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);

            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
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
            });
            $('.datepicker').on('click', datePickerInit);
            $('.datepicker').on('focus', datePickerInit);
        });
    </script>
    @yield('javascript')
</body>
</html>
