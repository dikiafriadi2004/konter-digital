@extends('front.layouts.app')

@section('title', $page->title)

@section('content')
    <main class="container mx-auto px-6 py-12 md:py-20">
        <h1 class="text-4xl md:text-5xl font-extrabold text-center text-text-primary mb-8 md:mb-12 scroll-animate">
            {{ $page->title }}
        </h1>

        <section class="bg-white p-6 md:p-10 rounded-lg shadow-2xl border border-gray-100 max-w-4xl mx-auto scroll-animate"
            style="transition-delay: 150ms;">

            {{-- kalau ada updated_at bisa tampilkan "terakhir diperbarui" --}}
            <p class="text-text-secondary mb-6 leading-relaxed">
                Terakhir diperbarui: {{ $page->updated_at->translatedFormat('d F Y') }}
            </p>

            {{-- konten pages dari database --}}
            <div class="prose max-w-none text-text-secondary leading-relaxed">
                {!! $page->body !!}
            </div>

        </section>
    </main>
@endsection
