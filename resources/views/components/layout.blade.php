<!doctype html>
<html lang="en">

<head>
    @include('partials.meta')
    <title>{{$heading}}</title>
</head>

<body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">

    @include('partials.head')
    <main class="flex flex-col h-screen justify-between">

        @include('partials.nav')
        {{ $slot }}
        @include('partials.footer')
    </main>
</body>

</html>