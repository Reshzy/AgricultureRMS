<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Farmers Record Management System</title>

    <!-- Favicon -->
    <!-- <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cdefs%3E%3ClinearGradient id='grad1' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2310B981'/%3E%3Cstop offset='100%25' stop-color='%230D9488'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath fill='url(%23grad1)' d='M576 96C576 204.1 499.4 294.3 397.6 315.4C389.7 257.3 363.6 205 325.1 164.5C365.2 104 433.9 64 512 64L544 64C561.7 64 576 78.3 576 96zM64 160C64 142.3 78.3 128 96 128L128 128C251.7 128 352 228.3 352 352L352 544C352 561.7 337.7 576 320 576C302.3 576 288 561.7 288 544L288 384C164.3 384 64 283.7 64 160z'/%3E%3C/svg%3E" type="image/svg+xml"> -->
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cdefs%3E%3ClinearGradient id='bg-gradient' x1='0%25' y1='0%25' x2='100%25' y2='0%25'%3E%3Cstop offset='0%25' stop-color='%2310B981'/%3E%3Cstop offset='100%25' stop-color='%230D9488'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='640' height='640' rx='80' fill='url(%23bg-gradient)'/%3E%3Cpath fill='%23FFFFFF' d='M576 96C576 204.1 499.4 294.3 397.6 315.4C389.7 257.3 363.6 205 325.1 164.5C365.2 104 433.9 64 512 64L544 64C561.7 64 576 78.3 576 96zM64 160C64 142.3 78.3 128 96 128L128 128C251.7 128 352 228.3 352 352L352 544C352 561.7 337.7 576 320 576C302.3 576 288 561.7 288 544L288 384C164.3 384 64 283.7 64 160z'/%3E%3C/svg%3E">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Lenis Smooth Scrolling -->
    <script src="https://unpkg.com/lenis@1.0.45/dist/lenis.min.js"></script>

    <!-- Lottie Animation Support -->
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg,
                    rgba(16, 185, 129, 0.1) 0%,
                    rgba(5, 150, 105, 0.2) 25%,
                    rgba(4, 120, 87, 0.3) 50%,
                    rgba(6, 95, 70, 0.4) 75%,
                    rgba(6, 78, 59, 0.5) 100%);
            position: relative;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(34, 197, 94, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-card {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(16, 185, 129, 0.2);
        }

        .stats-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(40px);
        }

        /* Ensure critical elements are always visible */
        nav,
        nav *,
        .hero-gradient h1,
        .hero-gradient p,
        .hero-gradient .gradient-text {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-10px) rotate(1deg);
            }

            50% {
                transform: translateY(-20px) rotate(0deg);
            }

            75% {
                transform: translateY(-10px) rotate(-1deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981, #059669, #047857);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .section-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .section-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            z-index: -1;
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #d1fae5 100%);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
            animation: float 20s infinite linear;
        }

        .floating-elements::before {
            width: 200px;
            height: 200px;
            top: 10%;
            left: -10%;
            animation-delay: 0s;
        }

        .floating-elements::after {
            width: 150px;
            height: 150px;
            top: 70%;
            right: -10%;
            animation-delay: -10s;
        }

        .nature-pattern {
            background-color: #ffffff;
            background-image:
                /* Grid pattern */
                linear-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.1) 1px, transparent 1px),
                /* Nature doodles pattern */
                radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.08) 2px, transparent 2px),
                radial-gradient(circle at 80% 80%, rgba(5, 150, 105, 0.06) 1.5px, transparent 1.5px),
                radial-gradient(circle at 40% 60%, rgba(4, 120, 87, 0.04) 1px, transparent 1px),
                radial-gradient(circle at 70% 30%, rgba(16, 185, 129, 0.05) 1.5px, transparent 1.5px);
            background-size:
                40px 40px,
                40px 40px,
                120px 120px,
                80px 80px,
                60px 60px,
                100px 100px;
            background-position:
                0 0,
                0 0,
                0 0,
                20px 20px,
                40px 10px,
                60px 50px;
        }

        .leaf-pattern {
            position: relative;
        }

        .leaf-pattern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                /* Leaf shapes using CSS */
                radial-gradient(ellipse 8px 4px at 25% 25%, rgba(16, 185, 129, 0.1) 40%, transparent 41%),
                radial-gradient(ellipse 6px 3px at 75% 75%, rgba(5, 150, 105, 0.08) 40%, transparent 41%),
                radial-gradient(ellipse 4px 2px at 50% 10%, rgba(4, 120, 87, 0.06) 40%, transparent 41%),
                radial-gradient(ellipse 5px 2.5px at 10% 90%, rgba(16, 185, 129, 0.07) 40%, transparent 41%),
                radial-gradient(ellipse 7px 3.5px at 90% 40%, rgba(5, 150, 105, 0.09) 40%, transparent 41%);
            background-size:
                200px 200px,
                150px 150px,
                100px 100px,
                180px 180px,
                160px 160px;
            background-position:
                0 0,
                50px 50px,
                100px 25px,
                25px 100px,
                75px 75px;
            pointer-events: none;
            opacity: 0.6;
        }

        /* Lottie Animation Parallax Styles */
        .lottie-parallax-container {
            position: absolute;
            /* left: -10%; */
            top: 50%;
            transform: translateY(-50%);
            width: 100vh;
            height: 100vh;
            min-width: 600px;
            min-height: 600px;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            pointer-events: none;
            overflow: visible;
        }

        .lottie-parallax-container.active {
            opacity: 0.6;
        }

        .lottie-parallax-container dotlottie-wc {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 20px rgba(16, 185, 129, 0.3));
        }

        /* Ensure features section has proper stacking context */
        #features {
            position: relative;
            z-index: 2;
        }

        #features .container {
            position: relative;
            z-index: 3;
        }

        /* News Section Background Icons */
        .news-bg-icons {
            overflow: visible;
        }

        .news-icon {
            transition: transform 0.3s ease, opacity 0.3s ease;
            will-change: transform;
        }

        /* Icon Positioning */
        .news-icon.icon-1 {
            top: 10%;
            left: 5%;
            transform: rotate(-15deg);
        }

        .news-icon.icon-2 {
            top: 20%;
            right: 8%;
            transform: rotate(20deg);
        }

        .news-icon.icon-3 {
            top: 50%;
            left: 2%;
            transform: rotate(-10deg);
        }

        .news-icon.icon-4 {
            bottom: 15%;
            right: 12%;
            transform: rotate(15deg);
        }

        .news-icon.icon-5 {
            top: 5%;
            right: 3%;
            transform: rotate(25deg);
        }

        .news-icon.icon-6 {
            bottom: 25%;
            left: 8%;
            transform: rotate(-20deg);
        }

        .news-icon.icon-7 {
            top: 35%;
            right: 15%;
            transform: rotate(10deg);
        }

        .news-icon.icon-8 {
            bottom: 10%;
            left: 15%;
            transform: rotate(-25deg);
        }

        /* Responsive Sizing */
        @media (max-width: 768px) {
            .news-icon {
                width: 3rem;
                height: 3rem;
            }

            .news-icon.icon-1,
            .news-icon.icon-3,
            .news-icon.icon-5,
            .news-icon.icon-8 {
                width: 4rem;
                height: 4rem;
            }
        }
    </style>
</head>

<body class="min-h-screen relative overflow-x-hidden">
    <!-- Parallax Background -->
    <div class="parallax-bg"></div>

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-seedling text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold gradient-text">Agriculture RMS</span>
                </div>

                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#features" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Features
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <!-- <a href="{{ route('about') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        About
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a> -->
                    <a href="#about" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        About
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <!-- <a href="{{ route('contact') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a> -->
                    <a href="#contact" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 text-emerald-600 font-semibold hover:bg-emerald-50 rounded-full transition-all duration-300">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 font-semibold hover:text-emerald-600 transition-all duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-2.5 text-white font-semibold rounded-full">
                        Get Started
                    </a>
                    @endif
                    @endauth

                    <button class="lg:hidden p-2 text-gray-600 hover:text-emerald-600 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <div class="floating-elements"></div>
        <div class="container mx-auto px-6 z-10 relative">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-800 text-sm font-medium">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span>Powered by Modern Technology</span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-black leading-tight">
                        <span class="block text-gray-900">Farmers Record</span>
                        <span class="block gradient-text">Management</span>
                        <span class="block text-gray-900">System</span>
                    </h1>

                    <p class="text-xl lg:text-2xl text-gray-700 leading-relaxed font-light max-w-2xl">
                        A digital solution for the Department of Agriculture Claveria to efficiently manage farmer records, crop data, and agricultural programs.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6 pt-4">
                        @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary px-8 py-4 text-white font-semibold rounded-2xl text-lg inline-flex items-center justify-center group">
                            <span>Access Dashboard</span>
                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn-primary px-8 py-4 text-white font-semibold rounded-2xl text-lg inline-flex items-center justify-center group">
                            <span>Start Your Journey</span>
                            <i class="fas fa-rocket ml-2 transition-transform group-hover:translate-x-1"></i>
                        </a>
                        @endauth

                        <a href="#features" class="px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-gray-800 font-semibold rounded-2xl text-lg hover:bg-white/20 transition-all duration-300 inline-flex items-center justify-center group">
                            <span>Discover Features</span>
                            <i class="fas fa-chevron-down ml-2 transition-transform group-hover:translate-y-1"></i>
                        </a>
                    </div>

                    <div class="flex items-center space-x-8 pt-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">1,250+</div>
                            <div class="text-gray-600 text-sm">Active Farmers</div>
                        </div>
                        <div class="w-px h-12 bg-gray-300"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">41</div>
                            <div class="text-gray-600 text-sm">Barangays Covered</div>
                        </div>
                        <div class="w-px h-12 bg-gray-300"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">24/7</div>
                            <div class="text-gray-600 text-sm">System Uptime</div>
                        </div>
                    </div>
                </div>

                <div class="relative animate-float">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-3xl blur-3xl opacity-20 animate-pulse"></div>
                    <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80"
                        alt="Modern farming technology"
                        class="relative z-0 w-full h-auto rounded-3xl shadow-2xl border border-white/20">

                    <!-- Floating Stats Cards -->
                    <div class="absolute -top-6 -left-6 glass-card p-4 rounded-2xl animate-float" style="animation-delay: 0.5s;">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-white text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Growth Rate</div>
                                <div class="text-emerald-600 font-bold">+23.5%</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -right-6 glass-card p-4 rounded-2xl animate-float" style="animation-delay: 1s;">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-white text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-white">New Farmers</div>
                                <div class="text-white font-bold">+847</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Widget -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background SVG Icons Container -->
        <div class="news-bg-icons absolute inset-0 pointer-events-none z-0">
            <!-- News Icons -->
            <!-- Newspaper Icon -->
            <svg class="news-icon icon-1 absolute w-24 h-24 text-emerald-500/10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H5v-2h9v2zm5-4H5v-2h14v2zm0-4H5V7h14v2z"/>
            </svg>
            <!-- Megaphone Icon -->
            <svg class="news-icon icon-2 absolute w-20 h-20 text-teal-500/10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
            </svg>
            <!-- Bell Icon -->
            <svg class="news-icon icon-3 absolute w-28 h-28 text-emerald-600/8" viewBox="0 0 24 24" fill="#10b981" fill-opacity="0.5">
                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
            </svg>
            <!-- Document Icon -->
            <svg class="news-icon icon-4 absolute w-16 h-16 text-teal-600/12" viewBox="0 0 24 24" fill="#10b981" fill-opacity="0.5">
                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
            </svg>
            <!-- Agricultural Icons -->
            <!-- Leaf Icon -->
            <svg class="news-icon icon-5 absolute w-32 h-32 text-emerald-500/8" viewBox="0 0 24 24" fill="#10b981" fill-opacity="0.5">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17 1 .26 1.53.26C17.86 20.22 22 12 22 12c-1-5-4-8-5-4z"/>
            </svg>
            <!-- Sprout/Plant Icon -->
            <svg class="news-icon icon-6 absolute w-22 h-22 text-teal-500/10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17 1 .26 1.53.26C17.86 20.22 22 12 22 12c-1-5-4-8-5-4z"/>
            </svg>
            <!-- Seed Icon -->
            <svg class="news-icon icon-7 absolute w-18 h-18 text-emerald-600/10" viewBox="0 0 24 24" fill="currentColor">
                <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1" fill="none"/>
                <circle cx="12" cy="12" r="3" fill="currentColor"/>
            </svg>
            <!-- Growing Plant Icon -->
            <!-- <svg class="news-icon icon-8 absolute w-26 h-26 text-teal-600/8" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17 1 .26 1.53.26C17.86 20.22 22 12 22 12c-1-5-4-8-5-4z"/>
            </svg> -->
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-12 section-reveal">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Latest <span class="gradient-text">News</span></h2>
                <p class="text-xl text-gray-600">Updates and advisories for our farmers</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php($latestNews = \App\Models\News::where('status','published')->whereNotNull('published_at')->where('published_at','<=', now())->orderByDesc('published_at')->limit(3)->get())
                    @forelse ($latestNews as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="feature-card bg-white p-6 group">
                        <div class="flex items-start space-x-4">
                            @if ($item->featured_image_path)
                            <img src="{{ Storage::disk('public')->url($item->featured_image_path) }}" alt="{{ $item->title }}" class="w-20 h-20 rounded object-cover">
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->title }}</h3>
                                <div class="text-sm text-gray-500">{{ $item->published_at?->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="md:col-span-3 text-center text-gray-500">No news yet. Check back soon.</div>
                    @endforelse
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('news.index') }}" class="btn-primary inline-flex items-center px-6 py-3 text-white font-semibold rounded-2xl">
                    <span>View All News</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <!-- <section class="py-20 relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 section-reveal">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Transforming Agriculture
                    <span class="gradient-text">Nationwide</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real-time insights and comprehensive data management across multiple sectors
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-user-tie text-white"></i>
                    </div>
                    <div class="text-3xl font-bold gradient-text mb-2">{{ number_format($stats['total_farmers']) }}</div>
                    <div class="text-gray-600 font-medium">Registered Farmers</div>
                </div>

                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-hard-hat text-white"></i>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($stats['total_laborers']) }}</div>
                    <div class="text-gray-600 font-medium">Active Laborers</div>
                </div>

                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-fish text-white"></i>
                    </div>
                    <div class="text-3xl font-bold text-cyan-600 mb-2">{{ number_format($stats['total_fisherfolks']) }}</div>
                    <div class="text-gray-600 font-medium">Fisherfolks</div>
                </div>

                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <div class="text-3xl font-bold text-purple-600 mb-2">{{ number_format($stats['total_agriyouth']) }}</div>
                    <div class="text-gray-600 font-medium">Agriyouth</div>
                </div>

                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="text-3xl font-bold text-orange-600 mb-2">{{ $stats['total_barangays'] }}</div>
                    <div class="text-gray-600 font-medium">Barangays</div>
                </div>

                <div class="stats-card p-6 rounded-2xl text-center group">
                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $stats['total_requests'] }}</div>
                    <div class="text-gray-600 font-medium">Active Requests</div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Features Section -->
    <section id="features" class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-white to-emerald-50"></div>

        <!-- Lottie Animation Parallax Container -->
        <div class="lottie-parallax-container" id="lottie-parallax">
            <dotlottie-wc
                src="https://lottie.host/f644b568-dddb-4988-9a82-abda09d21cce/WlpgVO0cbL.lottie"
                <!-- autoplay -->
                loop>
            </dotlottie-wc>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 section-reveal">
                <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-800 text-sm font-medium mb-6">
                    <i class="fas fa-sparkles text-emerald-500"></i>
                    <span>Cutting-Edge Features</span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Everything you need to
                    <span class="gradient-text">modernize agriculture</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Comprehensive tools designed specifically for agricultural record management
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Main Feature Card - Farmer Profiles (Takes 2 columns on large screens) -->
                <div class="md:col-span-2 lg:col-span-2 feature-card bg-gradient-to-br from-emerald-500 to-teal-600 p-12 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8">
                            <i class="fas fa-user-check text-3xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold mb-4">Comprehensive Farmer Profiles</h3>
                        <p class="text-emerald-100 text-lg mb-8 leading-relaxed">
                            Comprehensive digital profiles for all registered farmers including personal details, land information, and farming history with advanced data management capabilities.
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                                <span class="text-sm">Digital Records</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                                <span class="text-sm">Land Tracking</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Feature Card -->
                <div class="feature-card bg-white p-8 relative group">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Agricultural News & Updates</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Real-time data visualization and reporting news for agricultural purposes with comprehensive updates and advisories.
                    </p>
                </div>

                <!-- Mobile Access Feature Card -->
                <div class="feature-card bg-white p-8 group">
                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-mobile-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mobile Access</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Field officers can access and update records directly from their mobile devices with full functionality.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-32 relative overflow-hidden nature-pattern leaf-pattern">
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-emerald-50/20 to-teal-50/30"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 section-reveal">
                    <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-800 text-sm font-medium">
                        <i class="fas fa-info-circle text-emerald-500"></i>
                        <span>About Our System</span>
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                        About <span class="gradient-text">Agriculture RMS</span>
                    </h2>

                    <div class="space-y-6">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            This web-based system was created as a final project for the Department of Agriculture in Claveria to help them keep track of local farmers' information. It moves their old paper-based records online, making it easier for staff to collect, store, and find farmer details like names, birthdays, contact numbers, farm locations, and what they grow or raise. This shift to a digital system helps keep information more accurate, safe, and easy to access for those who need it.
                        </p>

                        <p class="text-lg text-gray-700 leading-relaxed">
                            The system is built to be straightforward, so even employees who are not very comfortable with computers can use it without trouble. From a simple main screen, they can view and update all farmer profiles. It also helps the office create useful summaries and reports, which are essential for planning events and ensuring resources like seeds or aid get to the right people. While it does need an internet connection to work, it saves a significant amount of time and reduces the office's reliance on paper files.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-8">
                        <div class="flex items-center space-x-4 p-4 glass-card rounded-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-check text-white"></i>
                                <svg role="img" viewBox="-8.5 -8 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <title>Google Cloud Storage</title>
                                    <path d="M24 2.4v8.4h-2.4V2.4H24zM0 10.8h2.4V2.4H0v8.4zm3-8.4h18v8.4H3V2.4zm12.6 4.2a1.8 1.8 0 1 0 3.6 0 1.8 1.8 0 0 0-3.6 0zm-10.8.6H12V6H4.8v1.2zm16.8 14.4H24v-8.4h-2.4v8.4zM0 21.6h2.4v-8.4H0v8.4zm3-8.4h18v8.4H3v-8.4zm12.6 4.2a1.8 1.8 0 1 0 3.6 0 1.8 1.8 0 0 0-3.6 0zM4.8 18H12v-1.2H4.8V18z" fill="#ffffff" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Secure Data Storage</h4>
                                <p class="text-gray-600 text-sm">Protected and encrypted</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 glass-card rounded-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users-cog text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">User-Friendly Interface</h4>
                                <p class="text-gray-600 text-sm">Easy for all skill levels</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 glass-card rounded-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-bar text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Smart Reporting</h4>
                                <p class="text-gray-600 text-sm">Automated summaries</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 glass-card rounded-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Time Efficient</h4>
                                <p class="text-gray-600 text-sm">Reduces paperwork</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative section-reveal">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-teal-500/20 rounded-3xl blur-3xl"></div>
                    <div class="relative bg-white/80 backdrop-blur-sm border border-white/20 rounded-3xl p-8 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1426&q=80"
                            alt="Department of Agriculture Office"
                            class="w-full h-auto rounded-2xl shadow-lg">

                        <!-- Floating Stats -->
                        <div class="absolute -top-4 -right-4 glass-card p-4 rounded-2xl animate-float">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-leaf text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">Digital Transform</div>
                                    <div class="text-emerald-600 font-bold">100%</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -left-4 glass-card p-4 rounded-2xl animate-float" style="animation-delay: 0.5s;">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">Paper Reduction</div>
                                    <div class="text-blue-600 font-bold">95%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section (Commented Out) -->
    <!--
    <section class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900"></div>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="floating-elements"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-200 text-sm font-medium mb-8">
                    <i class="fas fa-rocket text-emerald-300"></i>
                    <span>Ready to Transform Agriculture?</span>
                </div>

                <h2 class="text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                    Join the Digital
                    <span class="text-emerald-300">Revolution</span>
                </h2>

                <p class="text-xl lg:text-2xl text-emerald-100 mb-12 leading-relaxed max-w-3xl mx-auto">
                    Experience the future of agricultural management with cutting-edge technology designed for the modern Department of Agriculture.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary px-10 py-5 text-white font-bold text-lg rounded-2xl inline-flex items-center group">
                        <span>Access Your Dashboard</span>
                        <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="btn-primary px-10 py-5 text-white font-bold text-lg rounded-2xl inline-flex items-center group">
                        <span>Start Free Today</span>
                        <i class="fas fa-sparkles ml-3 transition-transform group-hover:scale-110"></i>
                    </a>
                    <a href="{{ route('login') }}" class="px-10 py-5 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-bold text-lg rounded-2xl hover:bg-white/20 transition-all duration-300 inline-flex items-center group">
                        <span>Admin Portal</span>
                        <i class="fas fa-shield-alt ml-3 transition-transform group-hover:scale-110"></i>
                    </a>
                    @endauth
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div class="glass-card p-6 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-emerald-500/20 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-clock text-emerald-300 text-xl"></i>
                        </div>
                        <h3 class="text-white font-bold mb-2">Quick Setup</h3>
                        <p class="text-emerald-200 text-sm">Get started in under 5 minutes</p>
                    </div>

                    <div class="glass-card p-6 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-headset text-blue-300 text-xl"></i>
                        </div>
                        <h3 class="text-white font-bold mb-2">24/7 Support</h3>
                        <p class="text-emerald-200 text-sm">Expert assistance when you need it</p>
                    </div>

                    <div class="glass-card p-6 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-shield-check text-purple-300 text-xl"></i>
                        </div>
                        <h3 class="text-white font-bold mb-2">Secure & Compliant</h3>
                        <p class="text-emerald-200 text-sm">Government-grade security standards</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->

    <!-- Contact Us Section -->
    <section id="contact" class="py-32 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(20,83,45,0.9) 0%, rgba(56,161,105,0.9) 100%);">
        <!-- Texture Overlay -->
        <div class="absolute inset-0 opacity-80" style="background-image: url('https://images.unsplash.com/photo-1619441207978-3d326c46e2c9?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; background-repeat: no-repeat; mix-blend-mode: multiply;"></div>
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="floating-elements"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 section-reveal">
                <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-white/90 text-sm font-medium mb-8">
                    <i class="fas fa-envelope text-white"></i>
                    <span>Get in Touch</span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Contact Us</h2>
                <p class="text-xl lg:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">Have questions? Reach out to our support team</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <!-- Contact Information -->
                <div class="space-y-8 section-reveal flex flex-col items-center justify-center">
                    <div class="glass-card p-8 rounded-3xl">
                        <h3 class="text-2xl font-bold text-white mb-8">Get in Touch</h3>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-lg mb-1">Address</h4>
                                    <p class="text-white/80 leading-relaxed">Department of Agriculture, Municipal Hall Compound, Claveria, Philippines</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-lg mb-1">Phone</h4>
                                    <p class="text-white/80">+63 123 456 7890</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-lg mb-1">Email</h4>
                                    <p class="text-white/80">agri.claveria@agriculture-rms.ph</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4 mt-8 pt-6 border-t border-white/20">
                            <a href="https://www.facebook.com/maofitsclaveria" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-2xl flex items-center justify-center text-white transition-all duration-300 group">
                                <i class="fab fa-facebook-f group-hover:scale-110 transition-transform"></i>
                            </a>
                            <!-- <a href="#" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-2xl flex items-center justify-center text-white transition-all duration-300 group">
                                <i class="fab fa-twitter group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-2xl flex items-center justify-center text-white transition-all duration-300 group">
                                <i class="fab fa-instagram group-hover:scale-110 transition-transform"></i>
                            </a> -->
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="section-reveal">
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-2xl">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-2xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <strong>Please fix the following errors:</strong>
                        </div>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="glass-card p-8 rounded-3xl space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-white font-semibold mb-3">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="w-full px-4 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 @error('name') border-red-400 @enderror"
                                    placeholder="Your full name" required>
                                @error('name')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-white font-semibold mb-3">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 @error('email') border-red-400 @enderror"
                                    placeholder="your.email@example.com" required>
                                @error('email')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-white font-semibold mb-3">Subject</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                class="w-full px-4 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 @error('subject') border-red-400 @enderror"
                                placeholder="What is this about?" required>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-white font-semibold mb-3">Message</label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full px-4 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 resize-none @error('message') border-red-400 @enderror"
                                placeholder="Tell us more about your inquiry..." required>{{ old('message') }}</textarea>
                            @error('message')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-4 bg-white text-green-800 font-bold text-lg rounded-2xl hover:bg-white/90 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl inline-flex items-center justify-center group">
                            <span>Send Message</span>
                            <i class="fas fa-paper-plane ml-3 transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-emerald-900/20"></div>
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-seedling text-white text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold gradient-text">Agriculture RMS</span>
                    </div>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8 max-w-md">
                        A digital solution for the Department of Agriculture Claveria to modernize agricultural record management.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/maofitsclaveria" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-gray-800 hover:bg-emerald-600 rounded-xl flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-facebook-f text-gray-300 hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-6">Navigation</h4>
                    <ul class="space-y-4">
                        <li><a href="#home" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center group">
                                <i class="fas fa-arrow-right text-emerald-500 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Home
                            </a></li>
                        <li><a href="#features" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center group">
                                <i class="fas fa-arrow-right text-emerald-500 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Features
                            </a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center group">
                                <i class="fas fa-arrow-right text-emerald-500 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                About
                            </a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 flex items-center group">
                                <i class="fas fa-arrow-right text-emerald-500 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Contact
                            </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-6">Categories</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Farmers Registry</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Workforce Management</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Fisherfolk Programs</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300">Agriyouth Development</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Agriculture RMS - Department of Agriculture Claveria. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lenis smooth scrolling
        let lenis;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lenis
            lenis = new Lenis({
                duration: 1.2,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                direction: 'vertical',
                gestureDirection: 'vertical',
                smooth: true,
                mouseMultiplier: 1,
                smoothTouch: false,
                touchMultiplier: 2,
                infinite: false,
            });

            // Lenis scroll event
            lenis.on('scroll', (e) => {
                updateParallax(e.scroll);
                updateNavbar(e.scroll);
                updateLottieParallax(e.scroll);
                updateNewsIconsParallax(e.scroll);
            });

            // Animation frame for Lenis
            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            // Lottie parallax variables
            let lottieContainer = document.getElementById('lottie-parallax');
            let featuresSection = document.getElementById('features');
            let lottieActive = false;

            // Lottie parallax function
            function updateLottieParallax(scrollY) {
                if (!lottieContainer || !featuresSection) return;

                const rect = featuresSection.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // Check if features section is in viewport
                const isInViewport = rect.top < windowHeight && rect.bottom > 0;

                if (isInViewport) {
                    if (!lottieActive) {
                        lottieContainer.classList.add('active');
                        lottieActive = true;
                    }

                    // Calculate parallax offset (moderate movement: 0.7x scroll speed)
                    const parallaxSpeed = 0.7;
                    const sectionTop = featuresSection.offsetTop;
                    const relativeScroll = scrollY - sectionTop;
                    const parallaxOffset = relativeScroll * parallaxSpeed;

                    lottieContainer.style.transform = `translateY(calc(-50% + ${parallaxOffset}px))`;
                } else {
                    if (lottieActive) {
                        lottieContainer.classList.remove('active');
                        lottieActive = false;
                    }
                }
            }

            // Updated smooth scrolling for anchor links with Lenis
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        lenis.scrollTo(targetElement, {
                            offset: -80,
                            duration: 1.5,
                            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
                        });
                    }
                });
            });

            // Intersection Observer for reveal animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            // Observe all elements with section-reveal class and reveal those already in view
            document.querySelectorAll('.section-reveal').forEach((el) => {
                // Check if element is already in viewport on load
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    el.classList.add('revealed');
                }
                observer.observe(el);
            });

            // Updated parallax scrolling effect for background elements
            function updateParallax(scrollY) {
                const parallaxElements = document.querySelectorAll('.parallax-bg');
                parallaxElements.forEach(element => {
                    const speed = 0.5;
                    const yPos = -(scrollY * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            }

            // News section background icons parallax
            function updateNewsIconsParallax(scrollY) {
                const newsIconsContainer = document.querySelector('.news-bg-icons');
                if (!newsIconsContainer) return;
                
                const newsSection = newsIconsContainer.closest('section');
                if (!newsSection) return;

                const rect = newsSection.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // Check if news section is in viewport
                const isInViewport = rect.top < windowHeight && rect.bottom > 0;

                if (isInViewport) {
                    const newsIcons = document.querySelectorAll('.news-icon');
                    const sectionTop = newsSection.offsetTop;
                    const relativeScroll = scrollY - sectionTop;

                    // Different parallax speeds for depth effect
                    const speeds = {
                        'icon-1': 0.3,
                        'icon-2': 0.5,
                        'icon-3': 0.4,
                        'icon-4': 0.6,
                        'icon-5': 0.35,
                        'icon-6': 0.45,
                        'icon-7': 0.55,
                        'icon-8': 0.4
                    };

                    newsIcons.forEach(icon => {
                        const iconClass = Array.from(icon.classList).find(cls => cls.startsWith('icon-'));
                        if (iconClass && speeds[iconClass]) {
                            const speed = speeds[iconClass];
                            const parallaxOffset = relativeScroll * speed;
                            
                            // Get base rotation from computed style or default
                            const computedStyle = window.getComputedStyle(icon);
                            const transform = computedStyle.transform || computedStyle.webkitTransform;
                            let baseRotation = '';
                            
                            // Extract rotation from CSS class (set in CSS)
                            if (iconClass === 'icon-1') baseRotation = 'rotate(-15deg)';
                            else if (iconClass === 'icon-2') baseRotation = 'rotate(20deg)';
                            else if (iconClass === 'icon-3') baseRotation = 'rotate(-10deg)';
                            else if (iconClass === 'icon-4') baseRotation = 'rotate(15deg)';
                            else if (iconClass === 'icon-5') baseRotation = 'rotate(25deg)';
                            else if (iconClass === 'icon-6') baseRotation = 'rotate(-20deg)';
                            else if (iconClass === 'icon-7') baseRotation = 'rotate(10deg)';
                            else if (iconClass === 'icon-8') baseRotation = 'rotate(-25deg)';
                            
                            icon.style.transform = `${baseRotation} translateY(${parallaxOffset}px)`;
                        }
                    });
                }
            }

            // Updated navbar background change on scroll
            const navbar = document.querySelector('nav');
            let lastScrollY = 0;

            function updateNavbar(scrollY) {
                if (scrollY > 50) {
                    navbar.classList.add('backdrop-blur-xl', 'bg-white/95');
                    navbar.classList.remove('bg-white/85');
                } else {
                    navbar.classList.remove('backdrop-blur-xl', 'bg-white/95');
                    navbar.classList.add('bg-white/85');
                }

                // Hide/show navbar on scroll
                if (scrollY > lastScrollY && scrollY > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }

                lastScrollY = scrollY;
            }

            // Advanced mobile menu toggle
            const mobileMenuButton = document.querySelector('.lg\\:hidden');
            const mobileMenu = document.querySelector('.lg\\:flex.items-center.space-x-8');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    const isHidden = mobileMenu.classList.contains('hidden');

                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.classList.add('flex', 'flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-6', 'shadow-xl', 'space-y-4', 'border-t');
                        mobileMenu.style.animation = 'slideDown 0.3s ease-out';
                    } else {
                        mobileMenu.style.animation = 'slideUp 0.3s ease-out';
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                            mobileMenu.classList.remove('flex', 'flex-col', 'absolute', 'top-full', 'left-0', 'right-0', 'bg-white', 'p-6', 'shadow-xl', 'space-y-4', 'border-t');
                        }, 300);
                    }
                });
            }

            // Animate stats counters
            const animateCounter = (element, target, duration = 2000) => {
                let start = 0;
                const increment = target / (duration / 16);

                const timer = setInterval(() => {
                    start += increment;
                    if (start >= target) {
                        element.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(start).toLocaleString();
                    }
                }, 16);
            };

            // Trigger counter animations when stats section is visible
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const counters = entry.target.querySelectorAll('.text-3xl.font-bold');
                        counters.forEach((counter) => {
                            const target = parseInt(counter.textContent.replace(/,/g, ''));
                            if (!isNaN(target)) {
                                counter.textContent = '0';
                                setTimeout(() => {
                                    animateCounter(counter, target);
                                }, 200);
                            }
                        });
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            const statsSection = document.querySelector('.grid.grid-cols-2.md\\:grid-cols-3.lg\\:grid-cols-6');
            if (statsSection) {
                statsObserver.observe(statsSection);
            }

            // Advanced button hover effects
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Cursor following effect for large screens
            if (window.innerWidth > 1024) {
                const cursor = document.createElement('div');
                cursor.className = 'fixed w-4 h-4 bg-emerald-500 rounded-full pointer-events-none z-50 opacity-0 transition-opacity duration-300';
                cursor.style.transform = 'translate(-50%, -50%)';
                document.body.appendChild(cursor);

                document.addEventListener('mousemove', (e) => {
                    cursor.style.left = e.clientX + 'px';
                    cursor.style.top = e.clientY + 'px';
                    cursor.style.opacity = '0.6';
                });

                document.addEventListener('mouseleave', () => {
                    cursor.style.opacity = '0';
                });

                // Scale cursor on hover
                document.querySelectorAll('a, button').forEach(element => {
                    element.addEventListener('mouseenter', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(2)';
                        cursor.style.backgroundColor = '#10b981';
                    });

                    element.addEventListener('mouseleave', () => {
                        cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                        cursor.style.backgroundColor = '#10b981';
                    });
                });
            }

            // Initialize page animations
            setTimeout(() => {
                document.body.classList.add('loaded');

                // Ensure critical elements are visible immediately
                document.querySelectorAll('nav, .hero-gradient h1, .hero-gradient p').forEach(el => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                });

                // Stagger animation delays for remaining elements
                document.querySelectorAll('.animate-fade-in:not(nav):not(.hero-gradient *), .animate-slide-up:not(nav):not(.hero-gradient *)').forEach((el, index) => {
                    el.style.animationDelay = (index * 0.1) + 's';
                });
            }, 50);
        });

        // Add CSS animations for mobile menu
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes slideUp {
                from { opacity: 1; transform: translateY(0); }
                to { opacity: 0; transform: translateY(-20px); }
            }
            nav {
                transition: transform 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
                opacity: 1 !important;
            }
            .gradient-text {
                opacity: 1 !important;
            }
            html {
                scroll-behavior: auto;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>