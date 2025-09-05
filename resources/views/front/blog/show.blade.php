@extends('front.layouts.app')

@section('title', $title)
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)
@push('meta_image')
    {{ $meta_image }}
@endpush

@section('content')
    <div class="container mx-auto px-6 py-12 lg:py-16">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">

            <!-- MAIN CONTENT -->
            <main class="lg:col-span-8">
                <div class="mb-4">
                    <span class="bg-indigo-100 text-indigo-700 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ $post->category->name ?? 'Umum' }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="mt-4 text-gray-500 flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img src="https://i.pravatar.cc/150?u={{ $post->user->id ?? 'anon' }}"
                            alt="{{ $post->user->name ?? 'Anonim' }}" class="w-8 h-8 rounded-full">
                        <span>Oleh {{ $post->user->name ?? 'Anonim' }}</span>
                    </div>
                    <span>&bull;</span>
                    <span>Dipublikasikan pada {{ $post->created_at->translatedFormat('d F Y') }}</span>
                </div>

                <figure class="mt-8 mb-10">
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('front/asset/img/default-blog.jpg') }}"
                        alt="{{ $post->title }}" class="w-full h-auto object-cover rounded-xl shadow-lg">
                    @if ($post->meta_description)
                        <figcaption class="text-center text-sm text-gray-500 mt-2">
                            {{ $post->meta_description }}
                        </figcaption>
                    @endif
                </figure>

                <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed tracking-wide">
                    {!! $post->body !!}
                </article>

                <!-- SOCIAL SHARE -->
                <div class="mt-12 border-t border-gray-200 pt-6">
                    <span class="font-semibold text-gray-700 mb-4 block">Bagikan artikel ini:</span>
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" rel="noopener" class="text-gray-500 hover:text-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                            target="_blank" rel="noopener" class="text-gray-500 hover:text-black">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 1200 1227">
                                <path
                                    d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.163 519.284ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.828Z" />
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->fullUrl()) }}"
                            target="_blank" rel="noopener" class="text-gray-500 hover:text-green-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.31 20.6C8.75 21.39 10.36 21.82 12.04 21.82C17.5 21.82 21.95 17.37 21.95 11.91C21.95 6.45 17.5 2 12.04 2M12.04 3.62C16.57 3.62 20.33 7.38 20.33 11.91C20.33 16.44 16.57 20.2 12.04 20.2C10.48 20.2 9 19.78 7.75 19.05L7.29 18.78L4.82 19.54L5.6 17.13L5.32 16.65C4.53 15.25 4.13 13.62 4.13 11.91C4.13 7.38 7.89 3.62 12.04 3.62M9.13 7.5C8.91 7.5 8.7 7.74 8.51 8.13C8.32 8.52 7.71 9.91 7.71 11.28C7.71 12.65 8.53 13.94 8.68 14.13C8.82 14.32 10.22 16.5 12.42 17.42C14.25 18.16 14.68 18.02 15.08 17.96C15.61 17.88 16.63 17.29 16.85 16.69C17.07 16.09 17.07 15.61 16.97 15.51C16.87 15.41 16.73 15.36 16.48 15.24C16.24 15.11 15.04 14.53 14.82 14.45C14.6 14.37 14.45 14.32 14.31 14.56C14.16 14.81 13.75 15.28 13.61 15.43C13.46 15.57 13.32 15.6 13.07 15.48C12.82 15.36 11.87 15.04 10.73 14.04C9.84 13.25 9.25 12.29 9.08 11.97C8.91 11.65 9.01 11.53 9.13 11.41C9.24 11.3 9.38 11.12 9.51 10.97C9.64 10.82 9.69 10.7 9.79 10.5C9.89 10.3 9.84 10.14 9.77 10.02C9.69 9.9 9.24 8.71 9.13 7.5Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </main>

            <!-- SIDEBAR: POPULAR POSTS -->
            <aside class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="sticky top-24">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Popular Posts</h3>
                        <div class="space-y-6">
                            @foreach ($popularPosts as $pop)
                                <a href="{{ route('blog.show', $pop->slug) }}" class="group flex items-start space-x-4">
                                    <img src="{{ $pop->thumbnail ? asset('storage/' . $pop->thumbnail) : asset('front/asset/img/default-blog.jpg') }}"
                                        class="w-20 h-20 object-cover rounded-lg flex-shrink-0" alt="{{ $pop->title }}">
                                    <div>
                                        <span class="text-indigo-600 text-xs font-semibold">
                                            {{ $pop->category->name ?? 'Umum' }}
                                        </span>
                                        <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">
                                            {{ Str::limit($pop->title, 50) }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>

    <!-- RELATED POSTS -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-10">Artikel Terkait Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($relatedPosts as $related)
                    <div
                        class="bg-gray-50 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                        <img src="{{ $related->thumbnail ? asset('storage/' . $related->thumbnail) : asset('front/asset/img/default-blog.jpg') }}"
                            class="w-full h-48 object-cover" alt="{{ $related->title }}">
                        <div class="p-6">
                            <span class="text-indigo-600 text-sm font-semibold">
                                {{ $related->category->name ?? 'Umum' }}
                            </span>
                            <a href="{{ route('blog.show', $related->slug) }}" class="block">
                                <h3 class="font-bold text-xl mt-2 mb-3">
                                    {{ Str::limit($related->title, 70) }}
                                </h3>
                            </a>
                            <a href="{{ route('blog.show', $related->slug) }}"
                                class="font-semibold text-indigo-600 hover:underline">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada artikel terkait.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
