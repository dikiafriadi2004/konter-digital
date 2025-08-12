<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('front/asset/css/app.css') }}" />


</head>

<body class="bg-base font-sans">
    @include('front.layouts.navbar')

    @yield('content')

    @include('front.layouts.footer')

    <script src="{{ asset('front/asset/js/app.js') }}"></script>
</body>

</html>
