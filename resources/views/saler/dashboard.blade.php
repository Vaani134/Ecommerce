<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saler Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="flex justify-center items-center min-h-screen">
        <div class="text-center">

            {{-- Dynamic welcome text from controller --}}
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">
                {{ $welcome }}
            </h1>

            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Hello Saler, 
            </p>

            {{-- ✅ Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Logout
                </button>
            </form>

        </div>
    </div>

</body>
</html>
