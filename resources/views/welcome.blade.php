<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel E-commerce</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-light antialiased">

    <div class="container-fluid d-flex flex-column justify-content-center align-items-center min-vh-100 py-4">
        <div class="text-center p-4">

            {{-- ✅ Show flash success message --}}
            @if(session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="display-4 fw-bold text-dark mb-4">
                🚀 Welcome to Laravel E-commerce
            </h1>

            {{-- ✅ Show login/register if not logged in --}}
            @guest
                <p class="lead text-muted mt-4">
                    Please 
                    <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login</a>
                    or 
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">Register</a>
                    to continue.
                </p>
            @endguest

            {{-- ✅ Show logout if logged in --}}
            @auth
                <p class="lead text-muted mt-4">
                    Welcome back, <span class="fw-bold text-dark">{{ Auth::user()->name }}</span> 🎉
                </p>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg">
                        Logout
                    </button>
                </form>
            @endauth

        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
