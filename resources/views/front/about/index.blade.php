@extends('front.layouts.app')

@section('title', 'Tentang Kami')

@section('content')

    <section class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
        <div class="container mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Memberdayakan Pebisnis Konter di Seluruh Indonesia
            </h1>
            <p class="mt-4 text-lg text-indigo-200 max-w-3xl mx-auto">
                Kami adalah Konter Digital, mitra teknologi Anda yang berdedikasi untuk menyediakan solusi server pulsa
                yang andal, cepat, dan menguntungkan.
            </p>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="text-center lg:text-left">
                    <div class="inline-block bg-indigo-100 p-4 rounded-full mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Misi Kami</h2>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Menyediakan platform PPOB dan server pulsa yang paling stabil dan mudah digunakan, sehingga
                        setiap pemilik konter dapat meningkatkan omzet dan melayani pelanggan dengan lebih baik.
                    </p>
                </div>
                <div class="text-center lg:text-left mt-12 lg:mt-0">
                    <div class="inline-block bg-purple-100 p-4 rounded-full mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Visi Kami</h2>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Menjadi tulang punggung digital bagi jutaan UMKM di Indonesia, mendorong inklusi keuangan dan
                        pertumbuhan ekonomi dari level akar rumput melalui teknologi yang aksesibel.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 sm:py-20">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 lg:gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?q=80&w=2047&auto=format&fit=crop"
                        alt="Tim Konter Digital sedang berdiskusi" class="rounded-lg shadow-xl w-full">
                </div>
                <div class="mt-8 lg:mt-0">
                    <h2 class="text-3xl font-bold text-gray-900">Perjalanan Kami</h2>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Konter Digital lahir dari sebuah garasi kecil pada tahun 2020, didirikan oleh sekelompok anak
                        muda yang melihat kesulitan para pemilik konter pulsa dengan aplikasi yang lambat dan layanan
                        pelanggan yang buruk.
                    </p>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Berbekal semangat dan keahlian di bidang teknologi, kami membangun platform dari nol dengan satu
                        fokus: <strong>keandalan</strong>. Kini, kami telah melayani ribuan agen di seluruh penjuru
                        negeri, memproses jutaan transaksi setiap bulannya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-6">
            <div class="bg-indigo-600 rounded-lg shadow-xl text-white p-8 md:p-12 text-center lg:text-left">
                <div class="flex flex-col lg:flex-row justify-between items-center lg:space-x-8">
                    <div>
                        <h2 class="text-3xl font-bold">Siap Mengembangkan Bisnis Anda?</h2>
                        <p class="mt-2 text-indigo-200 max-w-2xl">Jadilah bagian dari ribuan agen sukses lainnya. Unduh
                            aplikasi Konter Digital sekarang juga dan nikmati kemudahan bertransaksi.</p>
                    </div>
                    <div class="mt-6 lg:mt-0 flex-shrink-0">
                        <a href="#"
                            class="inline-block bg-white text-indigo-600 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                            Unduh Aplikasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
