<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - {{ config('app.name') }}</title>

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

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid rgba(16, 185, 129, 0.1);
        }

        .form-input:focus {
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            transform: translateY(-1px);
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
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        About
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-emerald-600 hover:text-emerald-600 font-medium transition-all duration-300 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-emerald-500"></span>
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
                        <i class="fas fa-envelope text-emerald-500"></i>
                        <span>Get In Touch</span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-black leading-tight mb-8">
                        <span class="block text-gray-900">Contact</span>
                        <span class="block gradient-text">Our Team</span>
                    </h1>

                    <p class="text-xl lg:text-2xl text-gray-700 leading-relaxed font-light max-w-4xl mx-auto">
                        Have questions about FarmTrack? Need support or want to learn more? We're here to help you transform agriculture.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-32 relative">
        <div class="container mx-auto px-6">
            <div class="max-w-7xl mx-auto">
                <!-- Contact Methods -->
                <div class="grid lg:grid-cols-3 gap-8 mb-20 section-reveal">
                    <div class="feature-card bg-white p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Visit Our Office</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Department of Agriculture<br>
                            Municipal Hall Compound<br>
                            Claveria, Misamis Oriental<br>
                            Philippines
                        </p>
                        <a href="#" class="text-emerald-600 font-medium hover:text-emerald-700 transition-colors">
                            Get Directions <i class="fas fa-external-link-alt ml-1"></i>
                        </a>
                    </div>

                    <div class="feature-card bg-white p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-phone-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Call Us Direct</h3>
                        <p class="text-gray-600 mb-4">
                            Speak with our support team<br>
                            Monday to Friday<br>
                            8:00 AM - 5:00 PM PST
                        </p>
                        <a href="tel:+631234567890" class="text-blue-600 font-medium hover:text-blue-700 transition-colors text-lg">
                            +63 123 456 7890
                        </a>
                    </div>

                    <div class="feature-card bg-white p-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-envelope text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Email Support</h3>
                        <p class="text-gray-600 mb-4">
                            Send us your questions<br>
                            We typically respond<br>
                            within 24 hours
                        </p>
                        <a href="mailto:agri.claveria@farmtrack.ph" class="text-purple-600 font-medium hover:text-purple-700 transition-colors">
                            agri.claveria@farmtrack.ph
                        </a>
                    </div>
                </div>

                <!-- Main Contact Form -->
                <div class="grid lg:grid-cols-2 gap-16 section-reveal">
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                                Let's Start a
                                <span class="gradient-text">Conversation</span>
                            </h2>
                            <p class="text-xl text-gray-600 leading-relaxed">
                                Whether you're a farmer, agricultural officer, or government official, we're here to support your journey toward modern agricultural management.
                            </p>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mt-1">
                                    <i class="fas fa-headset text-emerald-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">24/7 Technical Support</h4>
                                    <p class="text-gray-600">Our dedicated technical team is available around the clock to assist with any system issues or questions.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mt-1">
                                    <i class="fas fa-graduation-cap text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Training & Onboarding</h4>
                                    <p class="text-gray-600">Comprehensive training programs to help your team get the most out of FarmTrack's features.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mt-1">
                                    <i class="fas fa-cogs text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Custom Solutions</h4>
                                    <p class="text-gray-600">Tailored implementations to meet your specific agricultural management needs and requirements.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4 pt-4">
                            <a href="#" class="w-12 h-12 bg-emerald-100 hover:bg-emerald-200 rounded-xl flex items-center justify-center transition-colors duration-300">
                                <i class="fab fa-facebook-f text-emerald-600"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-blue-100 hover:bg-blue-200 rounded-xl flex items-center justify-center transition-colors duration-300">
                                <i class="fab fa-twitter text-blue-600"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-purple-100 hover:bg-purple-200 rounded-xl flex items-center justify-center transition-colors duration-300">
                                <i class="fab fa-linkedin-in text-purple-600"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-pink-100 hover:bg-pink-200 rounded-xl flex items-center justify-center transition-colors duration-300">
                                <i class="fab fa-instagram text-pink-600"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="feature-card bg-white p-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Send Us a Message</h3>

                        <form class="space-y-6" method="POST" action="#">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none"
                                        placeholder="Enter your first name" required>
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none"
                                        placeholder="Enter your last name" required>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email"
                                    class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none"
                                    placeholder="Enter your email address" required>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone"
                                    class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none"
                                    placeholder="Enter your phone number">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                                <select id="subject" name="subject"
                                    class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none"
                                    required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="support">Technical Support</option>
                                    <option value="training">Training Request</option>
                                    <option value="feature">Feature Request</option>
                                    <option value="demo">Request Demo</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="6"
                                    class="form-input w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:bg-white focus:outline-none resize-none"
                                    placeholder="Tell us more about your inquiry..." required></textarea>
                            </div>

                            <button type="submit"
                                class="btn-primary w-full py-4 text-white font-semibold rounded-xl text-lg inline-flex items-center justify-center group">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane ml-3 transition-transform group-hover:translate-x-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="mt-32 section-reveal">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Need Immediate Help?</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Explore our resources or get started with FarmTrack right away
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <a href="{{ route('about') }}" class="feature-card bg-gradient-to-br from-emerald-50 to-teal-50 p-8 text-center group hover:from-emerald-100 hover:to-teal-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-info-circle text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Learn More</h3>
                            <p class="text-gray-600">Discover how FarmTrack can transform your agricultural operations</p>
                        </a>

                        <a href="{{ route('home') }}#features" class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 p-8 text-center group hover:from-blue-100 hover:to-indigo-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-list-check text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">View Features</h3>
                            <p class="text-gray-600">Explore all the powerful features FarmTrack has to offer</p>
                        </a>

                        <a href="{{ route('register') }}" class="feature-card bg-gradient-to-br from-purple-50 to-pink-50 p-8 text-center group hover:from-purple-100 hover:to-pink-100">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-rocket text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Get Started</h3>
                            <p class="text-gray-600">Begin your journey with FarmTrack today</p>
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

            // Form input animations
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Form submission handling (mock)
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();

                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;

                // Simulate loading state
                button.innerHTML = '<i class="fas fa-spinner animate-spin mr-2"></i> Sending...';
                button.disabled = true;

                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-check mr-2"></i> Message Sent!';
                    button.classList.remove('btn-primary');
                    button.classList.add('bg-green-600');

                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.disabled = false;
                        button.classList.add('btn-primary');
                        button.classList.remove('bg-green-600');
                        this.reset();
                    }, 2000);
                }, 1500);
            });
        });

        // Add CSS for navbar transitions and form enhancements
        const style = document.createElement('style');
        style.textContent = `
            nav {
                transition: transform 0.3s ease, backdrop-filter 0.3s ease, background-color 0.3s ease;
                opacity: 1 !important;
            }
            .gradient-text {
                opacity: 1 !important;
            }
            .focused label {
                color: #10b981;
                transform: translateY(-2px);
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            .animate-spin {
                animation: spin 1s linear infinite;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>