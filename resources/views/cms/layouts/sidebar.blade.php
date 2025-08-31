<aside id="sidebar"
    class="bg-white dark:bg-slate-800 w-64 fixed inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-lg">
    <!-- Logo & Title -->
    <div class="p-4 flex items-center justify-center border-b border-slate-200 dark:border-slate-700">
        <img src="{{ asset('back/assets/img/logo.png') }}" alt="Logo" class="h-50 w-50 object-contain">
    </div>

    <nav id="main-nav" class="mt-4 px-2 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('cms.dashboard.index') }}"
            class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <!-- Posts & Categories submenu -->
        @canany(['Category Show', 'Posts Show'])
            <div>
                <button id="submenu-toggle"
                    class="w-full nav-link flex items-center justify-between px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Posts
                    </span>
                    <svg id="submenu-arrow" class="w-4 h-4 transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="submenu" class="hidden pl-8 mt-1 space-y-1">
                    @can('Category Show')
                        <a href="{{ route('categories.index') }}"
                            class="nav-link submenu-link block px-4 py-2 text-sm rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 border-l-4 border-transparent">Categories</a>
                    @endcan
                    @can('Posts Show')
                        <a href="{{ route('cms.posts.index') }}"
                            class="nav-link submenu-link block px-4 py-2 text-sm rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 border-l-4 border-transparent">Posts</a>
                    @endcan
                </div>
            </div>
        @endcanany

        <!-- Pages -->
        @can('Pages Show')
            <a href="{{ route('cms.pages.index') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Pages
            </a>
        @endcan

        <!-- Landing Page -->
        @can('Landing Show')
            <a href="{{ route('cms.landing.edit') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                <!-- Ikon Landing Page yang sesuai dengan icon landing -->
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7-5 7 5v11a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v6" />
                </svg>
                Landing Page
            </a>
        @endcan
        <!-- Menu Builder -->
        @canany(['Menu Create', 'Menu Delete'])
            <a href="{{ route('menus.index') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 border-l-4 border-transparent">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                Menu Builder
            </a>
        @endcanany

        <!-- Users -->
        @can('User Show')
            <a href="{{ route('users.index') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.975 5.975 0 0112 13a5.975 5.975 0 013 5.197M15 21a6 6 0 00-9-5.197" />
                </svg>
                Users
            </a>
        @endcan

        <!-- Roles -->
        @can('Role Show')
            <a href="{{ route('roles.index') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                Roles
            </a>
        @endcan

        <!-- Settings -->
        @can('Settings Show')
            <a href="{{ route('cms.settings.edit') }}"
                class="nav-link flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg border-l-4 border-transparent hover:bg-slate-100 dark:hover:bg-slate-700">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
        @endcan
    </nav>
</aside>
