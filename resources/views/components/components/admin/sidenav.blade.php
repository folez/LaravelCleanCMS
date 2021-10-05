<nav class="sidebar">
      <div class="sidebar-header px-2">
          <div class="row h-100 w-100 flex-nowrap m-0">
                <div class="col-10 sidebar-brand">
                    <div class="d-flex align-items-center h-100">
                         <a href="/" class="px-2">
                            <img src="{{asset('admin-resources/img/digital-logo.svg')}}" class="img-fluid w-100">
                        </a>
                    </div>
                </div>
              <div class="col d-flex justify-content-center align-items-center">
                  <button class="sidebar-toggler button-unstyled" onclick="adminFunctions.toggleSidebar()">
                      <i class="far fa-bars"></i>
                  </button>
              </div>
          </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item">
                <x-components.admin.sidenav-link link="{{route('admin.home')}}">
                    <x-slot name="icon">
                        <i class="far fa-home-alt"></i>
                    </x-slot>
                    Статистика
                </x-components.admin.sidenav-link>
            </li>
            <li class="nav-item">
                <x-components.admin.sidenav-link link="{{route('admin.languages')}}">
                    <x-slot name="icon">
                        <i class="fal fa-language fs-4"></i>
                    </x-slot>
                    Языки
                </x-components.admin.sidenav-link>
            </li>
            <li class="nav-item">
                <x-components.admin.sidenav-link link="{{route('admin.settings')}}">
                    <x-slot name="icon">
                        <i class="fal fa-cog"></i>
                    </x-slot>
                    Настройки
                </x-components.admin.sidenav-link>
            </li>

            <li class="nav-item">
                <x-components.admin.sidenav-link link="{{route('admin.logout')}}">
                    <x-slot name="icon">
                        <i class="fal fa-sign-out-alt" style="transform: rotate(180deg)"></i>
                    </x-slot>
                    Выйти
                </x-components.admin.sidenav-link>
            </li>
        </ul>
      </div>
    </nav>
