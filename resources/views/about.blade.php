<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cdefs%3E%3ClinearGradient id='grad1' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2310B981'/%3E%3Cstop offset='100%25' stop-color='%230D9488'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath fill='url(%23grad1)' d='M576 96C576 204.1 499.4 294.3 397.6 315.4C389.7 257.3 363.6 205 325.1 164.5C365.2 104 433.9 64 512 64L544 64C561.7 64 576 78.3 576 96zM64 160C64 142.3 78.3 128 96 128L128 128C251.7 128 352 228.3 352 352L352 544C352 561.7 337.7 576 320 576C302.3 576 288 561.7 288 544L288 384C164.3 384 64 283.7 64 160z'/%3E%3C/svg%3E" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
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

        .parallax-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            z-index: -1;
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #d1fae5 100%);
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

        nav,
        nav *,
        .hero-gradient h1,
        .hero-gradient p,
        .gradient-text {
            opacity: 1 !important;
            transform: translateY(0) !important;
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
                    <span class="text-2xl font-bold gradient-text">FarmTrack</span>
                </div>

                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('home') }}#features" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Features
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('about') }}" class="text-emerald-600 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        About
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-emerald-500"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
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
    <section class="hero-gradient min-h-screen flex items-center relative overflow-hidden pt-20">
        <div class="container mx-auto px-6 z-10 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-20 section-reveal">
                    <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-800 text-sm font-medium mb-8">
                        <i class="fas fa-info-circle text-emerald-500"></i>
                        <span>Learn About Our Mission</span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-black leading-tight mb-8">
                        <span class="block text-gray-900">About</span>
                        <span class="block gradient-text">FarmTrack</span>
                    </h1>

                    <p class="text-xl lg:text-2xl text-gray-700 leading-relaxed font-light max-w-4xl mx-auto">
                        Revolutionizing agricultural management through innovative digital solutions designed for the modern Department of Agriculture.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-32 relative">
        <div class="container mx-auto px-6">
            <div class="max-w-7xl mx-auto">
                <!-- What is FarmTrack Section -->
                <div class="grid lg:grid-cols-2 gap-16 items-center mb-32 section-reveal">
                    <div class="space-y-8">
                        <div class="inline-flex items-center space-x-2 px-4 py-2 glass-card rounded-full text-emerald-800 text-sm font-medium">
                            <i class="fas fa-seedling text-emerald-500"></i>
                            <span>What is FarmTrack?</span>
                        </div>

                        <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                            A Comprehensive Digital
                            <span class="gradient-text">Platform</span>
                        </h2>

                        <p class="text-xl text-gray-600 leading-relaxed">
                            FarmTrack is designed to modernize and streamline agricultural record management processes for the Department of Agriculture, bridging the gap between traditional farming and digital innovation.
                        </p>

                        <p class="text-lg text-gray-600 leading-relaxed">
                            Our system focuses on providing efficient tools for managing farmer records, crop data, and agricultural programs while ensuring better service delivery and accurate data collection for informed policy-making.
                        </p>

                        <div class="flex flex-wrap gap-4 pt-4">
                            <div class="flex items-center space-x-2 px-4 py-2 bg-emerald-50 rounded-full">
                                <i class="fas fa-check-circle text-emerald-500"></i>
                                <span class="text-emerald-700 font-medium">Government Compliant</span>
                            </div>
                            <div class="flex items-center space-x-2 px-4 py-2 bg-blue-50 rounded-full">
                                <i class="fas fa-shield-alt text-blue-500"></i>
                                <span class="text-blue-700 font-medium">Secure Data Management</span>
                            </div>
                            <div class="flex items-center space-x-2 px-4 py-2 bg-purple-50 rounded-full">
                                <i class="fas fa-mobile-alt text-purple-500"></i>
                                <span class="text-purple-700 font-medium">Mobile Accessible</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-3xl blur-3xl opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80"
                            alt="Modern agriculture technology"
                            class="relative z-10 w-full h-auto rounded-3xl shadow-2xl border border-white/20">
                    </div>
                </div>

                <!-- Features & Mission Grid -->
                <div class="grid lg:grid-cols-2 gap-16 mb-32">
                    <!-- Key Features -->
                    <div class="feature-card bg-white p-12 section-reveal">
                        <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-8">
                            <i class="fas fa-list-check text-white text-2xl"></i>
                        </div>

                        <h3 class="text-3xl font-bold text-gray-900 mb-8">Key Features</h3>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mt-1">
                                    <i class="fas fa-users text-emerald-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Centralized Farmer Profiles</h4>
                                    <p class="text-gray-600">Complete enrollment and management system for all agricultural stakeholders.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mt-1">
                                    <i class="fas fa-chart-line text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Crop Monitoring & Analytics</h4>
                                    <p class="text-gray-600">Real-time crop data tracking with advanced analytics and reporting.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mt-1">
                                    <i class="fas fa-cogs text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Program & Subsidy Management</h4>
                                    <p class="text-gray-600">Streamlined distribution and tracking of agricultural programs.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mt-1">
                                    <i class="fas fa-shield-check text-orange-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Secure Data Storage</h4>
                                    <p class="text-gray-600">Government-grade security for all agricultural data and records.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mt-1">
                                    <i class="fas fa-mobile-alt text-teal-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Mobile Accessibility</h4>
                                    <p class="text-gray-600">Field-friendly mobile access for agricultural officers and farmers.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Our Mission -->
                    <div class="feature-card bg-gradient-to-br from-emerald-500 to-teal-600 p-12 text-white relative overflow-hidden section-reveal">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>

                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8">
                                <i class="fas fa-bullseye text-3xl"></i>
                            </div>

                            <h3 class="text-3xl font-bold mb-8">Our Mission</h3>

                            <p class="text-emerald-100 text-lg mb-6 leading-relaxed">
                                To empower the Department of Agriculture with cutting-edge technology that simplifies record-keeping, enhances data accuracy, and supports informed decision-making for the benefit of our agricultural communities.
                            </p>

                            <p class="text-emerald-100 text-lg leading-relaxed mb-8">
                                We are committed to continuous improvement and providing a reliable, user-friendly system that adapts to the evolving needs of the agricultural sector.
                            </p>

                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                                    <span class="text-sm">Innovation Driven</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                                    <span class="text-sm">Farmer Focused</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-emerald-300 rounded-full"></div>
                                    <span class="text-sm">Future Ready</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-32 section-reveal">
                    <div class="text-center p-8 feature-card bg-white">
                        <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold gradient-text mb-2">1,250+</div>
                        <div class="text-gray-600 font-medium">Active Farmers</div>
                    </div>

                    <div class="text-center p-8 feature-card bg-white">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-blue-600 mb-2">15+</div>
                        <div class="text-gray-600 font-medium">Barangays</div>
                    </div>

                    <div class="text-center p-8 feature-card bg-white">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-chart-growth text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-purple-600 mb-2">99.9%</div>
                        <div class="text-gray-600 font-medium">Uptime</div>
                    </div>

                    <div class="text-center p-8 feature-card bg-white">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-orange-600 mb-2">24/7</div>
                        <div class="text-gray-600 font-medium">Support</div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="text-center section-reveal">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Ready to Transform Agriculture?</h2>
                    <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto">
                        Join thousands of farmers and agricultural professionals already using FarmTrack to modernize their operations.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('home') }}" class="btn-primary px-8 py-4 text-white font-semibold rounded-2xl text-lg inline-flex items-center group">
                            <span>Explore Features</span>
                            <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-1"></i>
                        </a>

                        <a href="{{ route('contact') }}" class="px-8 py-4 bg-white border-2 border-emerald-500 text-emerald-600 font-semibold rounded-2xl text-lg hover:bg-emerald-50 transition-all duration-300 inline-flex items-center group">
                            <span>Contact Us</span>
                            <i class="fas fa-envelope ml-3 transition-transform group-hover:scale-110"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Parallax scrolling effect
            let ticking = false;

            function updateParallax() {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax-bg');

                parallaxElements.forEach(element => {
                    const speed = 0.5;
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });

                ticking = false;
            }

            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }

            window.addEventListener('scroll', requestTick);

            // Navbar background change on scroll
            const navbar = document.querySelector('nav');
            let lastScrollY = window.scrollY;

            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;

                if (currentScrollY > 50) {
                    navbar.classList.add('backdrop-blur-xl', 'bg-white/95');
                    navbar.classList.remove('bg-white/85');
                } else {
                    navbar.classList.remove('backdrop-blur-xl', 'bg-white/95');
                    navbar.classList.add('bg-white/85');
                }

                // Hide/show navbar on scroll
                if (currentScrollY > lastScrollY && currentScrollY > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }

                lastScrollY = currentScrollY;
            });

            // Advanced button hover effects
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        // Add CSS for navbar transitions
        const style = document.createElement('style');
        style.textContent = `
            nav {
                transition: transform 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
                opacity: 1 !important;
            }
            .gradient-text {
                opacity: 1 !important;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>