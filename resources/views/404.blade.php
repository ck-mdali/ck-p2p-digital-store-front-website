{{-- resources/views/errors/404.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found | {{ config('app.name') }}</title>
    <meta name="description" content="The page you are looking for does not exist.">
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Tailwind CSS (if not already globally included) --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="max-w-xl w-full text-center">
        <h1 class="text-7xl font-extrabold text-indigo-600">404</h1>
        <p class="text-2xl font-semibold text-gray-800 mt-4">Oops! Page not found</p>
        <p class="text-gray-600 mt-2">The page you are looking for might have been removed or is temporarily unavailable.</p>

        <div class="mt-6">
            <a href="{{ url('/') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 transition">
                Go back home
            </a>
        </div>

        {{-- Optional: search bar or helpful links --}}
        <div class="mt-8 text-sm text-gray-500">
            Still lost? Email us your query <a href="mailto:help@cksoftwares.com" class="underline text-indigo-500">Email Now</a>.
        </div>
    </div>

</body>
</html>
