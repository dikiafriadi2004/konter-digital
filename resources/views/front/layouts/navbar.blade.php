<header class="bg-base shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('front/asset/img/logo.png') }}" alt="Logo Konter Digital" class="h-8" />
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8 items-center">
            @foreach ($menus as $menu)
                @php
                    $isActive = false;

                    if ($menu->url === '/' && request()->is('/')) {
                        $isActive = true;
                    } elseif ($menu->url !== '/' && request()->is(ltrim($menu->url, '/') . '*')) {
                        $isActive = true;
                    }
                @endphp

                <a href="{{ url($menu->url) }}"
                    class="nav-link text-text-primary hover:text-primary transition duration-300 py-2 {{ $isActive ? 'active' : '' }}">
                    {{ $menu->title }}
                </a>
            @endforeach
        </div>

        <!-- Mobile Toggle -->
        <div class="md:hidden">
            <button id="menu-btn" class="text-primary focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="menu" class="hidden md:hidden bg-base">
        @foreach ($menus as $menu)
            @php
                $isActive = false;

                if ($menu->url === '/' && request()->is('/')) {
                    $isActive = true;
                } elseif ($menu->url !== '/' && request()->is(ltrim($menu->url, '/') . '*')) {
                    $isActive = true;
                }
            @endphp

            <a href="{{ url($menu->url) }}"
                class="nav-link-mobile block py-2 px-6 text-sm text-text-primary hover:bg-primary hover:text-white {{ $isActive ? 'active' : '' }}">
                {{ $menu->title }}
            </a>
        @endforeach
    </div>
</header>
