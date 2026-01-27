<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981, #059669, #047857);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 32px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4);
        }

        .feature-card {
            transition: all .3s ease;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(2, 44, 34, .08);
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(16, 185, 129, .18);
        }

        .hero-bg {
            background: linear-gradient(135deg, rgba(16, 185, 129, .08), rgba(14, 165, 233, .06));
        }
    </style>
</head>

<body class="min-h-screen bg-emerald-50/40">
    <nav class="glass-nav sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg bg-white/60 hover:bg-white/80 text-emerald-900 transition shadow-sm inline-flex items-center gap-2"><i class="fa-solid fa-arrow-left"></i><span>Back to Home</span></a>
                <span class="ml-2 text-lg font-semibold gradient-text">{{ config('app.name') }}</span>
            </div>
            <a href="{{ route('news.index') }}" class="text-sm text-emerald-900/80 hover:text-emerald-900">News</a>
        </div>
    </nav>

    <header class="hero-bg border-b border-emerald-900/10">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white text-emerald-700 text-xs border border-emerald-900/10">Inspired by <a href="https://www.awwwards.com/" target="_blank" class="underline ml-1">Awwwards</a></div>
                    <h1 class="mt-3 text-3xl md:text-5xl font-black text-emerald-900">Latest <span class="gradient-text">News</span></h1>
                    <p class="mt-2 text-emerald-800/80 max-w-2xl">Updates, advisories, and stories for the agriculture community.</p>
                </div>
            </div>
        </div>
    </header>

    <main>
        @livewire('news-search')
    </main>

    <footer class="px-6 py-10 text-center text-sm text-emerald-800/70">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-arrow-left"></i> Back to Landing Page</a>
    </footer>
    @livewireScripts
</body>

</html>