<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    @stack('styles')
</head>
<body class="min-h-screen bg-white">
@include('partials.header-public')

<main class="min-h-[60vh]">
    @yield('content')
</main>

@include('partials.footer')

@stack('scripts')
@include('partials.header-scripts')
</body>
</html>
