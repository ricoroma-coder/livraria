{{--  implement main html  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    {{--  meta config  --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--  link css  --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{--  import title  --}}
    <title>@yield('title')</title>
</head>
<body>
    {{--  import component navbar  --}}
    @component('components.navbar')
    @endcomponent

    {{--  import component bg  --}}
    @component('components.bg')
    @endcomponent

    {{--  import content  --}}
    @yield('content')

    {{--  import component footer  --}}
    @component('components.footer')
    @endcomponent

    {{--  script javascript  --}}
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</body>
</html>