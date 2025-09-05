<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title & SEO --}}
    <title>
        {{ $setting->site_name ?? config('app.name') }} - @yield('title', $setting->meta_title ?? ($setting->site_name ?? config('app.name')))
    </title>
    <meta name="description" content="@yield('meta_description', $setting->meta_description ?? config('app.name'))">
    <meta name="keywords" content="@yield('meta_keywords', $setting->meta_keywords ?? '')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', $setting->meta_title ?? ($setting->site_name ?? config('app.name')))">
    <meta property="og:description" content="@yield('meta_description', $setting->meta_description ?? config('app.name'))">
    <meta property="og:site_name" content="{{ $setting->site_name ?? config('app.name') }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@stack('meta_image', asset($setting->logo ? 'storage/' . $setting->logo : 'front/asset/img/default-logo.png'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $setting->meta_title ?? ($setting->site_name ?? config('app.name')))">
    <meta name="twitter:description" content="@yield('meta_description', $setting->meta_description ?? config('app.name'))">
    <meta name="twitter:image" content="@stack('meta_image', asset($setting->logo ? 'storage/' . $setting->logo : 'front/asset/img/default-logo.png'))">

    {{-- Favicon --}}
    <link rel="icon"
        href="{{ $setting && $setting->favicon ? asset('storage/' . $setting->favicon) : asset('front/asset/img/favicon.png') }}"
        type="image/png">

    {{-- CSS & Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('front/asset/css/app.css') }}">
</head>

<body class="bg-base font-sans">
    @include('front.layouts.navbar')

    @yield('content')

    @include('front.layouts.footer')

    <script src="{{ asset('front/asset/js/app.js') }}"></script>
</body>

</html>
