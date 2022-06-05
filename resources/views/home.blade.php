<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
        integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>Step-tool</title>

    <!-- Fonts -->

</head>

<body class="antialiased">
    <style>
        * {
            font-family: 'Source Code Pro', monospace;

        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-transition: "color 9999s ease-out, background-color 9999s ease-out";
            -webkit-transition-delay: 9999s;
        }

        html {
            background-color: rgb(39 39 42);
            overflow-x: hidden;
        }

        .font-default {
            font-family: 'Source Code Pro', monospace;
        }

    </style>
    <div id="app">
        <router-view></router-view>
    </div>

    <script>
        window.Laravel = {!! json_encode([
    'logged' => Auth::check(),
    'user' => Auth::user(),
]) !!};


        function reload() {
            setTimeout(function() {
                window.location.reload();
            }, 1500)
        }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
</body>

</html>
