@extends('front.layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="text-center py-16 md:py-20 bg-white">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Hubungi Kami</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Punya pertanyaan, masukan, atau butuh bantuan? Tim kami siap membantu Anda. Jangan ragu untuk
                menghubungi kami melalui informasi di bawah atau isi formulir kontak.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20">
        <div class="container mx-auto px-6">
            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-6 p-4 text-green-800 bg-green-100 border border-green-200 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-5">
                    <h2 class="text-3xl font-bold text-gray-900">Informasi Kontak</h2>
                    <p class="mt-2 text-gray-600">Kami selalu senang mendengar dari Anda.</p>
                    <div class="mt-8 space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Alamat Kantor</h3>
                                <p class="text-gray-600">Jl. Jenderal Sudirman Kav. 52-53<br>Jakarta Selatan, DKI
                                    Jakarta, Indonesia 12190</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Alamat Email</h3>
                                <p class="text-gray-600">
                                    Dukungan: <a href="mailto:support@konterdigital.com"
                                        class="text-indigo-600 hover:underline">support@konterdigital.com</a><br>
                                    Kerjasama: <a href="mailto:partnership@konterdigital.com"
                                        class="text-indigo-600 hover:underline">partnership@konterdigital.com</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">Nomor Telepon</h3>
                                <p class="text-gray-600">(021) 515-1234 (Jam Kerja)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 bg-white p-8 rounded-lg shadow-lg">
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="full-name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="full-name" id="full-name" required
                                    class="w-full mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full text-white bg-cta-primary hover:bg-cta-hover focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition duration-300">
                                    Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi --}}
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900 text-center">Lokasi Kami</h2>
            <p class="mt-2 text-center text-gray-600">Kunjungi kami di kantor pusat kami di Jakarta.</p>
            <div class="mt-8">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.242944722839!2d106.80419337593175!3d-6.23175486103328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f138a7d8d85d%3A0x1e35b2e3e5a5a229!2sPacific%20Century%20Place%2C%20SCBD!5e0!3m2!1sen!2sid!4v1722700057168!5m2!1sen!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-xl"></iframe>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900 text-center">Pertanyaan Umum (FAQ)</h2>
            <div class="max-w-3xl mx-auto mt-8 space-y-4">
                <details class="bg-white p-6 rounded-lg shadow-md cursor-pointer">
                    <summary class="font-semibold text-lg">Bagaimana cara melakukan deposit saldo?</summary>
                    <p class="mt-4 text-gray-600">Anda dapat melakukan deposit melalui transfer bank ke rekening virtual
                        account yang tersedia di menu 'Deposit' pada aplikasi kami. Saldo akan masuk secara otomatis
                        setelah pembayaran terverifikasi.</p>
                </details>
                <details class="bg-white p-6 rounded-lg shadow-md cursor-pointer">
                    <summary class="font-semibold text-lg">Apakah transaksi di Konter Digital aman?</summary>
                    <p class="mt-4 text-gray-600">Tentu. Kami menggunakan enkripsi end-to-end untuk semua komunikasi dan
                        data transaksi. Selain itu, kami juga menerapkan sistem keamanan berlapis untuk melindungi akun
                        dan saldo Anda.</p>
                </details>
                <details class="bg-white p-6 rounded-lg shadow-md cursor-pointer">
                    <summary class="font-semibold text-lg">Apa yang harus dilakukan jika transaksi gagal tapi saldo
                        terpotong?</summary>
                    <p class="mt-4 text-gray-600">Jangan khawatir. Segera hubungi tim dukungan pelanggan kami melalui
                        email atau formulir kontak dengan menyertakan ID Transaksi. Tim kami akan segera melakukan
                        pengecekan dan pengembalian dana jika terbukti ada kesalahan sistem.</p>
                </details>
            </div>
        </div>
    </section>
@endsection
