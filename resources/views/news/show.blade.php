<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    </style>
</head>

<body class="min-h-screen bg-emerald-50/40">
    <nav class="glass-nav sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg bg-white/60 hover:bg-white/80 text-emerald-900 transition shadow-sm inline-flex items-center gap-2"><i class="fa-solid fa-arrow-left"></i><span>Back to Home</span></a>
                <a href="{{ route('news.index') }}" class="px-3 py-2 rounded-lg bg-white/60 hover:bg-white/80 text-emerald-900 transition shadow-sm inline-flex items-center gap-2"><i class="fa-solid fa-newspaper"></i><span>All News</span></a>
            </div>
            <span class="text-lg font-semibold gradient-text">{{ config('app.name') }}</span>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-6 py-10">
        <div class="text-emerald-800/70 text-sm mb-2">{{ $news->published_at?->format('F j, Y g:i A') }}</div>
        <h1 class="text-3xl md:text-5xl font-black text-emerald-900">{{ $news->title }}</h1>
        @if (!empty($news->categories))
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach ($news->categories as $category)
            <span class="px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">{{ ucfirst($category) }}</span>
            @endforeach
        </div>
        @endif

        @if ($news->featured_image_path)
        <div class="mt-6 feature-card bg-white">
            <img src="{{ Storage::disk('public')->url($news->featured_image_path) }}" alt="{{ $news->title }}" class="w-full object-cover">
        </div>
        @endif

        <article class="prose max-w-none mt-6 text-emerald-900">
            {!! nl2br(e($news->content)) !!}
        </article>

        @if (!empty($news->tags))
        <div class="mt-6 flex flex-wrap gap-2">
            @foreach ($news->tags as $tag)
            <span class="px-2 py-1 text-sm bg-emerald-50 text-emerald-700 rounded-full border border-emerald-900/10">#{{ $tag }}</span>
            @endforeach
        </div>
        @endif

        <div class="mt-10 flex items-center justify-between">
            <a href="{{ route('news.index') }}" class="text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-2"><i class="fa-solid fa-arrow-left"></i> Back to News</a>
            <a href="{{ route('home') }}" class="btn-primary text-white px-5 py-2.5 rounded-xl inline-flex items-center gap-2"><i class="fa-solid fa-house"></i> Home</a>
        </div>
    </main>
</body>

</html>