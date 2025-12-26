<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="text-center card p-5 shadow">

            {{-- Dynamic welcome text from controller --}}
            <h1 class="display-4 fw-bold text-dark">
                {{ $welcome }}
            </h1>

            <p class="mt-2 text-muted">
                Hello Admin, 
            </p>

            {{-- ✅ Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" 
                        class="btn btn-danger btn-lg">
                    Logout
                </button>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper from CDN (required for some components like dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
