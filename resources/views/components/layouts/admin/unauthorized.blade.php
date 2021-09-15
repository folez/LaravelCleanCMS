<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
     <meta name="viewport"
           content="
               width=device-width,
               user-scalable=no,
               initial-scale=1.0,
               maximum-scale=1.0,
               minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>{{env('ADMIN_TITLE')}}</title>
    {{-- Assets --}}
    <link rel="stylesheet" href="{{asset('shared/assets/bootstrap5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/styles/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-resources/styles/style.css')}}">
    {{-- Fonts --}}
    <link rel="stylesheet" href="{{asset('shared/fonts/Gilroy/stylesheet.css')}}">
    {{-- Project styles --}}
    @livewireStyles
    @stack('styles')
</head>
<body>

    {{$slot}}

    {{--  Assets  --}}
    <script src="{{asset('shared/assets/bootstrap5/js/bootstrap.bundle.min.js')}}"></script>
    {{--  Project scripts  --}}
    @livewireScripts
    @stack('modals')
    @stack('scripts')

</body>
</html>
