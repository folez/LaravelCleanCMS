<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <x-stateles.navigation.nav-link class="navbar-brand" href="/admin">
                    <b>
                        <img src="{{asset('assets/img/logo_mob.svg')}}" alt="">
                    </b>
                    <span>
                    <img src="{{asset('assets/img/logo.svg')}}" alt="">
                </span>
                </x-stateles.navigation.nav-link>
            </div>
            <div class="navbar-collapse">
                {{--    Sidebar toggle buttons    --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <x-stateles.navigation.nav-link class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)" match="none">
                            <i class="fal fa-bars"></i>
                        </x-stateles.navigation.nav-link>
                    </li>
                    <li class="nav-item">
                        <x-stateles.navigation.nav-link class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)" match="none">
                            <i class="fal fa-bars"></i>
                        </x-stateles.navigation.nav-link>
                    </li>
                </ul>
                {{--    Sidebar toggle buttons    --}}
                {{--    Other buttons    --}}
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <x-stateles.markup.dropdown bodyClass="animate__animated animate__fast animate__bounceInDown" class="waves-effect waves-dark nav-link">
                            <x-slot name="head">pfoile</x-slot>
                            <x-stateles.navigation.nav-link class="nav-link waves-effect waves-dark d-block" href="#">Выход</x-stateles.navigation.nav-link>
                        </x-stateles.markup.dropdown>
                    </li>
                </ul>
                {{--    Other buttons    --}}
            </div>
        </div>
    </nav>
</header>
