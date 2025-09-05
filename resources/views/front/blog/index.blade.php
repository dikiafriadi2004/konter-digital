@extends('front.layouts.app')

@section('title', $title ?? null)
@section('meta_description', $meta_description ?? null)
@section('meta_keywords', $meta_keywords ?? null)

@section('content')
    <main>
        <section id="blog" class="py-20 bg-neutral">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-animate">
                    <h2 class="text-3xl md:text-4xl font-bold text-text-primary">Dari Blog Kami</h2>
                    <p class="text-text-secondary mt-2">Tips, trik, dan berita terbaru seputar bisnis pulsa.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse ($posts as $post)
                        <div
                            class="bg-base rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition duration-300 scroll-animate">
                            <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://placehold.co/600x400/2563eb/FFFFFF?text=No+Image' }}"
                                alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <p class="text-sm text-text-secondary">{{ $post->created_at->translatedFormat('d F Y') }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="block">
                                    <h3
                                        class="font-bold text-xl mt-2 text-text-primary hover:text-primary transition duration-300">
                                        {{ $post->title }}
                                    </h3>
                                </a>
                                <p class="text-text-secondary mt-2">
                                    {{ Str::limit(strip_tags($post->body), 120) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="text-primary hover:underline mt-4 inline-block font-semibold">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-text-secondary">Belum ada artikel tersedia.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-12">
                    {{ $posts->links('pagination::custom-paginate') }}
                </div>
            </div>
        </section>
    </main>
@endsection
