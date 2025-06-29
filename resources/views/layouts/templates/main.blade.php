<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard - Mazer Admin Dashboard')</title>

    {{-- Include header (CSS, meta tag, dsb) --}}
    @include('layouts.partials.header')
</head>
<body>

    {{-- Include sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Konten utama --}}
    <div class="main">
        @yield('content')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; Soegitos</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted By Soegitos</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Include footer --}}
    @include('layouts.partials.footer')

</body>
</html>
