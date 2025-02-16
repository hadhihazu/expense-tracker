<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DompetFlow</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

        <link rel="apple-touch-icon" sizes="180x180" href="/favico/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favico/favicon-16x16.png">
        <link rel="manifest" href="/favico/site.webmanifest">

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
        <body class="font-sans antialiased bg-[url(/images/bg.webp)] backdrop-blur-xl bg-right bg-cover text-white min-h-screen flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center py-6 px-8">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="images/dark-logo.png" alt="DompetFlow Logo" class="h-10 w-auto">
                <h1 class="text-2xl font-bold text-white">DompetFlow</h1>
            </div>

            <!-- Navigation -->
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 font-bold text-black transition hover:text-black/70 dark:text-white dark:hover:text-white/80">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-[#007f8e] text-white rounded-lg font-medium transition hover:bg-[#005f6e]">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-[#007f8e] rounded-md transition hover:bg-gray-200">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section with Gradient -->
        <section class="text-white py-20 text-center">
            <h1 class="text-5xl font-extrabold">Take Control of Your Finances</h1>
            <p class="mt-3 text-lg">DompetFlow helps you track your expenses, manage your budget, and gain financial clarity.</p>
            <a href="/register" class="mt-6 inline-block bg-[#007f8e] text-white px-6 py-3 rounded-lg font-medium transition hover:bg-[#005f6e]">
                Get Started for Free
            </a>
        </section>

        <!-- Features Section -->
        <section class="py-16 px-8 text-center">
            <h2 class="text-4xl font-semibold text-white]">Why Choose <span class="font-bold">DompetFlow?</span></h2>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-lg shadow-[0px_0px_10px_5px_rgba(0,_0,_0,_0.1)] text-white">
                    <h3 class="text-xl font-bold"><i class="fa-solid fa-coins pe-1"></i> Smart Expense Tracking</h3>
                    <p class="mt-2">Automatically categorize and monitor your spending habits.</p>
                </div>
                <div class="p-6 rounded-lg shadow-[0px_0px_10px_5px_rgba(0,_0,_0,_0.1)] text-white">
                    <h3 class="text-xl font-bold"><i class="fa-solid fa-chart-simple pe-1"></i> Real-Time Budget Analysis</h3>
                    <p class="mt-2">Compare your spending with your set budget and avoid overspending.</p>
                </div>
                <div class="p-6 rounded-lg shadow-[0px_0px_10px_5px_rgba(0,_0,_0,_0.1)] text-white">
                    <h3 class="text-xl font-bold"><i class="fa-solid fa-calendar pe-1"></i> Monthly Reports & Insights</h3>
                    <p class="mt-2">Visual charts and trends help you make informed financial decisions.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center py-6">
            <p class="text-sm text-white">
                &copy; {{ date('Y') }} DompetFlow. All rights reserved.
            </p>
        </footer>
    </body>
</html>
