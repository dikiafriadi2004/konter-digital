@extends('front.layouts.app')

@section('title', 'Home')

@section('content')
    <main>
        <!-- Hero Section - Diperbarui untuk kesan mewah, elegan, dan modern -->
        <section id="home"
            class="bg-gradient-to-br from-hero-gradient-start to-hero-gradient-end text-white relative overflow-hidden py-24 md:py-40">
            <!-- Elemen dekoratif latar belakang (opsional, bisa dihapus jika terlalu kompleks) -->
            <div class="absolute inset-0 z-0 opacity-10"
                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

            <div class="container mx-auto px-6 relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left scroll-animate">
                    <h1 class="text-5xl md:text-6xl font-black leading-tight tracking-tight drop-shadow-lg">
                        Solusi Server Pulsa Modern untuk Bisnis Anda
                    </h1>
                    <p class="mt-4 text-xl text-blue-200 leading-relaxed drop-shadow-md">
                        Cepat, Aman, Otomatis — Kelola pulsa dengan Konter Digital
                    </p>
                    <div
                        class="mt-10 flex flex-col items-center md:items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="contact.html"
                            class="bg-cta-primary hover:bg-cta-hover text-white font-bold py-4 px-10 rounded-full transition duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-center">
                            Coba Sekarang
                        </a>
                        <a href="privacy.html"
                            class="bg-transparent border-2 border-white hover:bg-white hover:text-hero-gradient-end text-white font-bold py-4 px-10 rounded-full transition duration-300 shadow-md hover:shadow-xl text-center">
                            Lihat Fitur
                        </a>
                    </div>
                    <a href="#"
                        class="mt-6 inline-flex items-center justify-center bg-gray-900/70 text-white rounded-full px-6 py-3 space-x-3 hover:bg-gray-900/90 transition duration-300 shadow-lg w-full sm:w-auto">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.5,9.13a2.3,2.3,0,0,1-1.55-2.22,2.42,2.42,0,0,1,2.42-2.43,2.39,2.39,0,0,1,2.42,2.43,2.3,2.3,0,0,1-1.55,2.22l-1.74.83Z M3,4.27,14.22,15.55l3.1-3.1L5.59,1,3,2.62Z M15.53,16.8,4.24,5.51,2.62,8.08,13.23,18.7l2.3-1.9Z M17.33,12.2a2.31,2.31,0,0,1,1.56,2.23,2.42,2.42,0,0,1-2.42,2.42,2.39,2.39,0,0,1-2.42-2.42,2.31,2.31,0,0,1,1.56-2.23l1.72-.83Z M20.4,11,17.7,12.35l-2.9,2.9,2.57,2.57,3-1.53Z" />
                        </svg>
                        <div class="text-left">
                            <p class="text-xs uppercase opacity-80">Get it on</p>
                            <p class="text-lg font-semibold">Google Play</p>
                        </div>
                    </a>
                </div>
                <div class="flex justify-center scroll-animate" style="transition-delay: 300ms;">
                    <img src="{{ asset('front/asset/img/konterdigital.png') }}" alt="Aplikasi Konter Digital"
                        class="transform md:rotate-6 max-w-full h-auto" />
                </div>
            </div>
        </section>
        <section class="py-16 bg-base">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-text-primary mb-2 scroll-animate">
                    Produk Terlengkap & Terpercaya
                </h2>
                <p class="text-text-secondary mb-12 scroll-animate">
                    Kami mendukung semua provider dan e-wallet populer di Indonesia.
                </p>
                <div
                    class="w-full overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                    <div class="flex w-max items-center gap-x-16 animate-scroll">
                        <div class="flex items-center gap-x-16" aria-hidden="true">
                            <img class="h-10 shrink-0" src="https://assets.telkomsel.com/public/logo-telkomsel.png"
                                alt="Telkomsel" />
                            <img class="h-9 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1280px-Logo_dana_blue.svg.png"
                                alt="DANA" />
                            <img class="h-10 shrink-0"
                                src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhEHP_C85fHYvoUpOBk3cZqzRpTETYBJLEBRoKHSEKBltUUNrIKdLKKWdwSmY7-FdxC7gEC2REVlpXQHxHozcuGgXD-PCj0HgcOsHpl3oW8B8kGxptETuUN8DVqJTKeHFWMQopZTZTS1V2DyC9mw0awTWnY0UQvoKIC0c07vfz4Dk1V5C1Nbck9oOs9/s320/GKL2_Indosat%20Ooredoo%20Hutchison%20-%20Koleksilogo.com.jpg"
                                alt="Indosat" />
                            <img class="h-12 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/512px-Logo_ovo_purple.svg.png"
                                alt="OVO" />
                            <img class="h-12 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/1000px-Shopee.svg.png"
                                alt="ShopeePay" />
                            <img class="h-8 shrink-0" src="https://tri.co.id/assets/image/logo_tri_black.png"
                                alt="Three" />
                            <img class="h-10 shrink-0" src="https://gopay.co.id/assets/img/logo/gopay.webp"
                                alt="GoPay" />
                        </div>
                        <div class="flex items-center gap-x-16" aria-hidden="true">
                            <img class="h-10 shrink-0" src="https://assets.telkomsel.com/public/logo-telkomsel.png"
                                alt="Telkomsel" />
                            <img class="h-9 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1280px-Logo_dana_blue.svg.png"
                                alt="DANA" />
                            <img class="h-10 shrink-0"
                                src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhEHP_C85fHYvoUpOBk3cZqzRpTETYBJLEBRoKHSEKBltUUNrIKdLKKWdwSmY7-FdxC7gEC2REVlpXQHxHozcuGgXD-PCj0HgcOsHpl3oW8B8kGxptETuUN8DVqJTKeHFWMQopZTZTS1V2DyC9mw0awTWnY0UQvoKIC0c07vfz4Dk1V5C1Nbck9oOs9/s320/GKL2_Indosat%20Ooredoo%20Hutchison%20-%20Koleksilogo.com.jpg"
                                alt="Indosat" />
                            <img class="h-12 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/512px-Logo_ovo_purple.svg.png"
                                alt="OVO" />
                            <img class="h-12 shrink-0"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/1000px-Shopee.svg.png"
                                alt="ShopeePay" />
                            <img class="h-8 shrink-0" src="https://tri.co.id/assets/image/logo_tri_black.png"
                                alt="Three" />
                            <img class="h-10 shrink-0" src="https://gopay.co.id/assets/img/logo/gopay.webp"
                                alt="GoPay" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="fitur" class="py-20 bg-neutral">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-animate">
                    <h2 class="text-3xl md:text-4xl font-bold text-text-primary">Fitur Unggulan Kami</h2>
                    <p class="text-text-secondary mt-2">Semua yang Anda butuhkan dalam satu platform.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-base p-8 rounded-xl shadow-md text-center transform hover:-translate-y-2 transition duration-300 scroll-animate">
                        <div
                            class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-text-primary mt-6">Pengisian Otomatis</h3>
                        <p class="text-text-secondary mt-2 text-sm">Transaksi diproses 24/7 secara otomatis tanpa perlu
                            campur tangan manual.</p>
                    </div>
                    <div class="bg-base p-8 rounded-xl shadow-md text-center transform hover:-translate-y-2 transition duration-300 scroll-animate"
                        style="transition-delay: 150ms;">
                        <div
                            class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-text-primary mt-6">Saldo Real-Time</h3>
                        <p class="text-text-secondary mt-2 text-sm">Pantau saldo dan mutasi dana Anda secara langsung
                            kapan saja.</p>
                    </div>
                    <div class="bg-base p-8 rounded-xl shadow-md text-center transform hover:-translate-y-2 transition duration-300 scroll-animate"
                        style="transition-delay: 300ms;">
                        <div
                            class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-text-primary mt-6">Riwayat Transaksi</h3>
                        <p class="text-text-secondary mt-2 text-sm">Laporan lengkap dan detail semua transaksi yang
                            pernah Anda lakukan.</p>
                    </div>
                    <div class="bg-base p-8 rounded-xl shadow-md text-center transform hover:-translate-y-2 transition duration-300 scroll-animate"
                        style="transition-delay: 450ms;">
                        <div
                            class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.273-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.125-1.273.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-text-primary mt-6">Sistem Referral</h3>
                        <p class="text-text-secondary mt-2 text-sm">Dapatkan penghasilan pasif dengan mengajak teman
                            bergabung.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class="py-20 bg-base">
            <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
                <div class="scroll-animate">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1484&auto=format&fit=crop"
                        alt="Tim Konter Digital" class="rounded-lg shadow-xl w-full" />
                </div>
                <div class="scroll-animate" style="transition-delay: 150ms">
                    <h2 class="text-3xl font-bold text-text-primary">
                        Tentang Konter Digital
                    </h2>
                    <p class="mt-4 text-text-secondary">
                        Konter Digital lahir dari kebutuhan untuk menyediakan solusi
                        server pulsa yang tidak hanya handal, tetapi juga modern dan mudah
                        digunakan. Kami berkomitmen untuk mendukung pertumbuhan bisnis
                        agen pulsa di seluruh Indonesia melalui teknologi terdepan.
                    </p>
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-text-primary">
                            Visi & Misi
                        </h3>
                        <ul class="mt-2 list-disc list-inside text-text-secondary space-y-2">
                            <li>
                                Menjadi platform server pulsa nomor satu yang paling dipercaya
                                di Indonesia.
                            </li>
                            <li>
                                Memberdayakan UMKM dan agen pulsa dengan teknologi yang
                                efisien dan menguntungkan.
                            </li>
                            <li>
                                Memberikan layanan pelanggan terbaik dengan respon yang cepat
                                dan solutif.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog" class="py-20 bg-neutral">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-animate">
                    <h2 class="text-3xl md:text-4xl font-bold text-text-primary">
                        Dari Blog Kami
                    </h2>
                    <p class="text-text-secondary mt-2">
                        Tips, trik, dan berita terbaru seputar bisnis pulsa.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-base rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition duration-300 scroll-animate">
                        <img src="https://images.unsplash.com/photo-1554495573-2d277b5f1784?q=80&w=1470&auto=format&fit=crop"
                            alt="Blog Image" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <p class="text-sm text-text-secondary">3 Agustus 2025</p>
                            <a href="detail-blog.html" class="block">
                                <h3 class="font-bold text-xl mt-2 text-text-primary">
                                    5 Cara Meningkatkan Omzet Konter Pulsa
                                </h3>
                            </a>
                            <p class="text-text-secondary mt-2">
                                Pelajari strategi jitu untuk menaikkan keuntungan bisnis pulsa
                                Anda di era digital.
                            </p>
                            <a href="#" class="text-primary hover:underline mt-4 inline-block font-semibold">Baca
                                Selengkapnya &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-base rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition duration-300 scroll-animate"
                        style="transition-delay: 150ms">
                        <img src="https://images.unsplash.com/photo-1633113089632-62432c38ade0?q=80&w=1470&auto=format&fit=crop"
                            alt="Blog Image" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <p class="text-sm text-text-secondary">28 Juli 2025</p>
                            <a href="detail-blog.html" class="block">
                                <h3 class="font-bold text-xl mt-2 text-text-primary">
                                    Mengapa Sistem Referral Penting?
                                </h3>
                            </a>
                            <p class="text-text-secondary mt-2">
                                Manfaatkan kekuatan word-of-mouth untuk mendapatkan
                                penghasilan pasif.
                            </p>
                            <a href="#" class="text-primary hover:underline mt-4 inline-block font-semibold">Baca
                                Selengkapnya &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-base rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition duration-300 scroll-animate"
                        style="transition-delay: 300ms">
                        <img src="https://images.unsplash.com/photo-1586941829035-662b2d6f29a2?q=80&w=1470&auto=format&fit=crop"
                            alt="Blog Image" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <p class="text-sm text-text-secondary">20 Juli 2025</p>
                            <a href="detail-blog.html" class="block">
                                <h3 class="font-bold text-xl mt-2 text-text-primary">
                                    Keamanan Transaksi Digital: Yang Perlu Anda Tahu
                                </h3>
                            </a>
                            <p class="text-text-secondary mt-2">
                                Pastikan bisnis dan pelanggan Anda aman dari penipuan dengan
                                tips berikut.
                            </p>
                            <a href="#" class="text-primary hover:underline mt-4 inline-block font-semibold">Baca
                                Selengkapnya &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
