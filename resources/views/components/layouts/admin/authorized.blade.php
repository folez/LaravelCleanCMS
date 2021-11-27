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

    {{-- Fonts --}}
    <link rel="stylesheet" href="{{asset('shared/fonts/Gilroy/stylesheet.css')}}">

    {{-- Styles --}}
    @livewireStyles
    <link rel="stylesheet" href="{{asset('shared/assets/bootstrap5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/styles/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/fontawesome5/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/niceselect/nice-select2.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/choices.js/styles/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('shared/assets/flatpickr/flatpickr.css')}}">
    <link rel="stylesheet" href="{{asset('admin-resources/styles/style.css')}}{{!env('APP_STYLE_CACHE', true)?"?time=".time():"?v=1"}}">
    @stack('styles')
    @livewireScripts

</head>
<body>

    <div class="main-wrapper">
        <x-components.admin.sidenav/>
        <div class="page-wrapper">
            <nav class="navbar">
                <button class="sidebar-toggler d-lg-none button-unstyled" onclick="adminFunctions.toggleSidebar()">
                  <i class="far fa-bars"></i>
                </button>
                <div class="navbar-content">
                    <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                        <a style="text-decoration:none;" href="{{route('admin.logout')}}"  class="d-none d-sm-flex align-items-center ms-3 py-1 exit-btn">Выход <i class="fal fa-sign-out-alt ms-2" style="transform: rotate(180deg)"></i></a>
                    </div>
                </div>
            </nav>
            <div class="page-content">
                {{$slot??'404'}}
            </div>
        </div>
    </div>

    {{--  Assets  --}}
    <script src="{{asset('shared/assets/bootstrap5/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('shared/assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('shared/assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('shared/assets/niceselect/nice-select2.js')}}"></script>
    <script src="{{asset('shared/assets/choices.js/scripts/choices.min.js')}}"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>--}}
    <script src="{{asset('shared/assets/ckeditor5/build/translations/uk.js')}}"></script>
    <script src="{{asset('shared/assets/ckeditor5/build/ckeditor.js')}}"></script>
    <script src="{{asset('shared/assets/tiny_mce/tinymce.min.js')}}"></script>
    {{--  Project scripts  --}}
    @stack('modals')
    @stack('scripts')
    <script src="{{asset('admin-resources/js/CKEditorUploadAdapter.js')}}"></script>
    <script src="{{asset('admin-resources/js/admin-functions.js')}}?{{time()}}"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @stack('adminFunctionsExtension')
</body>
</html>
