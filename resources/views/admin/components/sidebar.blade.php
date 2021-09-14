<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <x-stateles.navigation.nav-link class="waves-effect waves-dark" match="all" href="/admin">
                        <i class="fal fa-columns"></i>
                        <span class="hide-menu">Статистика</span>
                    </x-stateles.navigation.nav-link>
                </li>
                <li class="divider"></li>
                <li>
                    <x-stateles.navigation.nav-link class="waves-effect waves-dark" match="prefix" href="/admin/users">
                        <i class="fal fa-users"></i>
                        <div class="hide-menu">Пользователи</div>
                    </x-stateles.navigation.nav-link>
                </li>
                <li class="divider"></li>
                <li>
                    <x-stateles.markup.collapse bodyClass="sidebarCollapse" class="waves-effect waves-dark has-arrow">
                        <x-slot name="head">
                            <i class="fal fa-file-alt"></i>
                            <span class="hide-menu">Страницы</span>
                        </x-slot>
                        <x-stateles.navigation.nav-link match="none" href="/admin/pages">Текстовые страницы</x-stateles.navigation.nav-link>
                    </x-stateles.markup.collapse>
                </li>
            </ul>
        </nav>
    </div>
</aside>
