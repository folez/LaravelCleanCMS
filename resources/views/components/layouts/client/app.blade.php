<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyMycoLab</title>

    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('shared/assets/bootstrap5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/choices.js/styles/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/styles/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/fontawesome5/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/fancybox/css/fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}{{!env('APP_STYLE_CACHE', true)?"?time=".time():""}}">
    @stack('styles')

    @livewireScripts
</head>
<body>
<x-client.components.navbar/>

<main>
    {{$slot}}
</main>

<x-client.components.footer/>

<script src="{{asset('shared/assets/bootstrap5/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('shared/assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('shared/assets/fancybox/js/fancybox.min.js')}}"></script>
<script src="{{asset('shared/assets/choices.js/scripts/choices.min.js')}}"></script>

@stack('scripts')

<script>
    function openNav() {
        let sidenavOverlay = document.querySelector('.sidenav-overlay')
        let sidenav = document.querySelector('.sidenav')
        let burgerButton = document.querySelector('a[data-toggle="sidebar"]')

        if(sidenav.classList.contains('show')){
            document.querySelector('body').classList.remove('overflow-scroll')
            sidenavOverlay.classList.remove('show')
            sidenav.classList.remove('show')
            burgerButton.classList.remove('change')
        } else {
            document.querySelector('body').classList.add('overflow-scroll')
            sidenavOverlay.classList.add('show')
            sidenav.classList.add('show')
            burgerButton.classList.add('change')
        }
    }

    function closeNav(){
        document.querySelector('.sidenav-overlay').classList.remove('show')
        document.querySelector('.sidenav').classList.remove('show')
        document.querySelector('a[data-toggle="sidebar"]').classList.remove('change')
    }
</script>
</body>
</html>
