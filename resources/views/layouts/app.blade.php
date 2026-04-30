<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PreloveU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav style="padding: 16px; border-bottom: 1px solid #ddd;">
        <a href="{{ route('products.index') }}">PreloveU</a>

        <div style="float: right;">
            @auth
                <span>{{ Auth::user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main style="padding: 24px;">
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>