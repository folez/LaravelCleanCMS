<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titlePage??setting('seo.title')}}</title>
    <meta property='og:image' content='{{asset(setting('seo.ogg_image'))}}' />

    <meta name="keywords" content="{{$keywordsPage??setting('seo.keywords')}}" />

    <meta name="description" content="{{$descriptionPage??setting('seo.description')}}" />

    <link rel="apple-touch-icon" type="image/vnd.microsoft.icon" sizes="76x76" href="{{asset(setting('global.favicon'))}}">
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset(setting('global.favicon'))}}">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{asset(setting('global.favicon'))}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="76x76" href="{{asset(setting('global.favicon'))}}">
    <link rel="icon" type="image/x-icon" href="{{asset(setting('global.favicon'))}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(setting('global.favicon'))}}">

    @livewireStyles
    <link rel="stylesheet" href="{{asset('shared/assets/bootstrap5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/styles/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/fontawesome5/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/fancybox/css/fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}{{!env('APP_STYLE_CACHE', true)?"?time=".time():""}}">
    @stack('styles')

    @if(setting('google.tag'))
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{setting('google.tag')}}');</script>
    <!-- End Google Tag Manager -->
    @endif

    @if(setting('google.analytic'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{setting('google.analytic')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{setting('google.analytic')}}');
    </script>
    @endif

    @if(setting('facebook.pixel'))
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{setting('facebook.pixel')}}');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id={{setting('facebook.pixel')}}&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    @endif

    {{setting('global.head')}}

    @livewireScripts
</head>
<body>
@if(setting('google.tag'))
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{setting('google.tag')}}"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif

<main>
    {{$slot}}
</main>


<script src="{{asset('shared/assets/bootstrap5/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('shared/assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('shared/assets/fancybox/js/fancybox.min.js')}}"></script>

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
