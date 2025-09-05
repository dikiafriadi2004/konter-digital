<footer class="bg-footer-elegant-blue text-blue-200">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <a href="{{ url('/') }}" class="flex items-center">
                    @if ($setting && $setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                            class="h-8" />
                    @else
                        <span class="text-white font-bold">{{ $setting->site_name }}</span>
                    @endif
                </a>
                <p class="mt-4 text-blue-300 text-sm">
                    {{ $setting->office_address ?? '' }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold tracking-wider text-white">Menu</h3>
                <ul class="mt-4 space-y-2">
                    @foreach ($menus as $menu)
                        <li class="text-sm">
                            <a href="{{ url($menu->url) }}" class="hover:text-white transition duration-300">
                                {{ $menu->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="font-semibold tracking-wider text-white">Ikuti Kami</h3>
                <div class="flex mt-4 space-x-4">
                    @if ($setting && $setting->facebook)
                        <a href="{{ $setting->facebook }}" target="_blank"
                            class="hover:text-white transition duration-300" aria-label="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z" />
                            </svg>
                        </a>
                    @endif

                    @if ($setting && $setting->twitter)
                        <a href="{{ $setting->twitter }}" target="_blank"
                            class="hover:text-white transition duration-300" aria-label="Twitter">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4.36a9.06 9.06 0 0 1-2.88 1.1A4.52 4.52 0 0 0 16.5 0c-2.63 0-4.76 2.13-4.76 4.76 0 .37.04.73.12 1.07A12.9 12.9 0 0 1 3.1 1.67a4.76 4.76 0 0 0 1.47 6.35A4.45 4.45 0 0 1 2 7.1v.06c0 2.26 1.6 4.15 3.73 4.58a4.5 4.5 0 0 1-2.14.08c.6 1.87 2.35 3.23 4.42 3.27A9.06 9.06 0 0 1 0 19.54a12.8 12.8 0 0 0 6.94 2.03c8.33 0 12.88-6.9 12.88-12.88 0-.2 0-.39-.01-.58A9.18 9.18 0 0 0 23 3z" />
                            </svg>
                        </a>
                    @endif

                    @if ($setting && $setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank"
                            class="hover:text-white transition duration-300" aria-label="Instagram">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.2c3.2 0 3.6.01 4.85.07 3.25.15 4.77 1.69 4.92 4.92.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.15 3.23-1.67 4.77-4.92 4.92-1.25.06-1.65.07-4.85.07s-3.6-.01-4.85-.07c-3.23-.15-4.77-1.69-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.15-3.23 1.69-4.77 4.92-4.92C8.4 2.21 8.8 2.2 12 2.2zm0-2.2C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.2 4.35 2.63 6.78 6.98 6.98 1.28.06 1.69.07 4.95.07s3.67-.01 4.95-.07c4.35-.2 6.78-2.63 6.98-6.98.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07 15.67.01 15.26 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zm0 10.16a4 4 0 1 1 0-8.01 4 4 0 0 1 0 8.01zm6.41-11.84a1.44 1.44 0 1 0 0-2.88 1.44 1.44 0 0 0 0 2.88z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>


            <div>
                <h3 class="font-semibold tracking-wider text-white">Layanan Pelanggan</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    @if ($setting && $setting->whatsapp)
                        <li class="flex items-center">
                            CS (WhatsApp):
                            <a href="https://wa.me/{{ $setting->whatsapp }}" class="ml-2 hover:text-white">
                                {{ $setting->whatsapp_formatted }}
                            </a>
                        </li>
                    @endif
                    @if ($setting->telegram)
                        <li class="flex items-center">
                            CS (Telegram):
                            <a href="https://t.me/{{ ltrim($setting->telegram, '@') }}" class="ml-2 hover:text-white">
                                {{ $setting->telegram }}
                            </a>
                        </li>
                    @endif
                    @if ($setting->telegram_channel)
                        <li class="flex items-center">
                            Channel (Telegram):
                            <a href="https://t.me/{{ ltrim($setting->telegram_channel, '@') }}"
                                class="ml-2 hover:text-white">
                                {{ $setting->telegram_channel }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-300 text-center text-blue-300 text-sm">
            <p>&copy; {{ date('Y') }} {{ $setting->site_name ?? 'Website' }}. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
