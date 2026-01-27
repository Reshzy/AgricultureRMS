<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name').' • Admin')</title>

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cdefs%3E%3ClinearGradient id='grad1' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2310B981'/%3E%3Cstop offset='100%25' stop-color='%230D9488'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath fill='url(%23grad1)' d='M576 96C576 204.1 499.4 294.3 397.6 315.4C389.7 257.3 363.6 205 325.1 164.5C365.2 104 433.9 64 512 64L544 64C561.7 64 576 78.3 576 96zM64 160C64 142.3 78.3 128 96 128L128 128C251.7 128 352 228.3 352 352L352 544C352 561.7 337.7 576 320 576C302.3 576 288 561.7 288 544L288 384C164.3 384 64 283.7 64 160z'/%3E%3C/svg%3E" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
    <style>
        .glass {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.6);
        }

        .sidebar-gradient {
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, #166534 0%, #14532d 40%, #022c22 100%);
        }

        /* Create a second gradient that will fade in smoothly */
        .sidebar-gradient::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, #166534 0%, #14532d 90%, #022c22 100%);
            opacity: 0;
            transition: opacity 0.3s ease-out;
            pointer-events: none;
            z-index: 0;
        }

        /* Sidebar content should be above the overlay */
        .sidebar-gradient>* {
            position: relative;
            z-index: 1;
        }

        /* On hover, fade the overlay in */
        #sidebar:hover::before {
            opacity: 1;
        }

        .card-hover {
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(2, 44, 34, .15);
        }

        .no-transition {
            transition: none !important;
        }

        .scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .scrollbar::-webkit-scrollbar-thumb {
            background: rgba(2, 44, 34, .2);
            border-radius: 8px;
        }

        /* Hide sidebar texts when collapsed */
        #sidebar.collapsed .brand-text,
        #sidebar.collapsed .nav-label,
        #sidebar.collapsed .support-text {
            display: none;
        }

        #sidebar.collapsed .nav-text {
            justify-content: center;
        }

        /* Dropdown styles */
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            min-width: 12rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(2, 44, 34, .15);
            border: 1px solid rgba(5, 150, 105, .1);
            overflow: hidden;
            z-index: 50;
        }

        .profile-dropdown.show {
            display: block;
            animation: dropdownFadeIn 0.2s ease;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            const sidebarStateKey = 'adminSidebarCollapsed';

            sidebar?.classList.add('no-transition');
            main?.classList.add('no-transition');

            const applySidebarState = (collapsed) => {
                if (!sidebar || !main) {
                    return;
                }

                if (collapsed) {
                    sidebar.classList.remove('w-72');
                    sidebar.classList.add('w-20', 'collapsed');
                    main.classList.remove('ml-72');
                    main.classList.add('ml-20');
                } else {
                    sidebar.classList.remove('w-20', 'collapsed');
                    sidebar.classList.add('w-72');
                    main.classList.remove('ml-20');
                    main.classList.add('ml-72');
                }
            };

            const savedSidebarState = localStorage.getItem(sidebarStateKey);
            if (savedSidebarState !== null) {
                applySidebarState(savedSidebarState === 'true');
            }

            requestAnimationFrame(() => {
                sidebar?.classList.remove('no-transition');
                main?.classList.remove('no-transition');
            });

            toggle?.addEventListener('click', () => {
                const nextState = !(sidebar?.classList.contains('collapsed'));
                applySidebarState(nextState);
                localStorage.setItem(sidebarStateKey, String(nextState));
            });

            // Profile dropdown toggle
            const profileBtn = document.getElementById('profileDropdownBtn');
            const profileDropdown = document.getElementById('profileDropdown');

            profileBtn?.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileDropdown?.contains(e.target) && e.target !== profileBtn) {
                    profileDropdown?.classList.remove('show');
                }
            });
        });
    </script>
</head>

<body class="min-h-screen bg-emerald-50/40">
    <div class="fixed inset-0 -z-10" aria-hidden="true">
        <div class="absolute -top-32 -right-24 w-[40rem] h-[40rem] rounded-full opacity-20 blur-3xl" style="background: radial-gradient(closest-side, #10b981, transparent)"></div>
        <div class="absolute -bottom-24 -left-24 w-[36rem] h-[36rem] rounded-full opacity-20 blur-3xl" style="background: radial-gradient(closest-side, #0ea5e9, transparent)"></div>
    </div>

    <aside id="sidebar" class="sidebar-gradient text-white fixed top-0 left-0 h-screen w-72 transition-all duration-300 shadow-xl">
        <div class="px-5 py-4 flex items-center gap-3 border-b border-white/10">
            <div class="w-10 h-10 rounded-xl bg-white/10 grid place-items-center">
                <!-- <i class="fa-solid fa-seedling text-lg"></i> -->
                <x-application-logo />
            </div>
            <div class="leading-tight brand-text">
                <div class="font-bold">Claveria DA</div>
                <div class="text-xs text-emerald-200">Admin Console</div>
            </div>
        </div>
        <nav class="px-3 py-4 space-y-1 text-sm pb-32">
            <a href="{{ route('home') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                <i class="fa-solid fa-home"></i>
                <span class="nav-label">Landing Page</span>
            </a>
            <a href="{{ route('dashboard') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                <i class="fa-solid fa-gauge"></i>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="{{ route('admin.enrollments.index') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.enrollments.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                <i class="fa-solid fa-users"></i>
                <span class="nav-label">Enrollments</span>
            </a>
            <a href="{{ route('admin.news.index') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.news.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                <i class="fa-solid fa-newspaper"></i>
                <span class="nav-label">News</span>
            </a>
            <a href="{{ route('admin.emails.index') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.emails.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                <i class="fa-solid fa-envelope"></i>
                <span class="nav-label">Emails</span>
                @php
                    try {
                        $unreadCount = \App\Models\ContactMessage::unread()->count();
                    } catch (\Exception $e) {
                        $unreadCount = 0;
                    }
                @endphp
                @if($unreadCount > 0)
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 min-w-[20px] text-center">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10' : 'hover:bg-white/10' }}">
                <i class="fa-solid fa-user-shield"></i>
                <span class="nav-label">Users</span>
            </a>
            <a href="{{ route('profile.show') }}" class="nav-text flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition">
                <i class="fa-solid fa-gear"></i>
                <span class="nav-label">Settings</span>
            </a>
        </nav>
        <div class="absolute bottom-16 left-0 right-0 px-3 pb-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full nav-text flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-600/90 transition text-left">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-label">Logout</span>
                </button>
            </form>
        </div>
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-white/10 text-xs text-emerald-200">
            <div class="nav-text flex items-center gap-2">
                <i class="fa-regular fa-circle-question"></i>
                <span class="support-text">Need help? Contact support</span>
            </div>
        </div>
    </aside>

    <main id="main" class="transition-all duration-300 ml-72">
        <header class="glass sticky top-0 z-40 backdrop-saturate-150 border-b border-emerald-900/10">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button id="sidebarToggle" class="px-3 py-2 rounded-lg bg-white/60 hover:bg-white/80 text-emerald-900 transition shadow-sm"><i class="fa-solid fa-bars"></i></button>
                    <h1 class="text-lg font-semibold text-emerald-900">@yield('header', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <!-- <button class="relative px-3 py-2 rounded-lg bg-white/60 hover:bg-white/80 text-emerald-900 transition shadow-sm">
                        <i class="fa-regular fa-bell"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[10px] grid place-items-center">3</span>
                    </button> -->
                    <div class="relative">
                        <button id="profileDropdownBtn" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/80 transition shadow-sm">
                            <img src="https://i.pravatar.cc/100?img=12" class="w-8 h-8 rounded-full border border-white/70" alt="User" />
                            <span class="text-sm font-medium text-emerald-900">{{ Auth::user()->name ?? 'Admin' }}</span>
                            <i class="fa-solid fa-chevron-down text-xs text-emerald-900"></i>
                        </button>
                        <div id="profileDropdown" class="profile-dropdown">
                            <div class="py-2">
                                <div class="px-4 py-2 border-b border-emerald-900/10">
                                    <p class="text-sm font-semibold text-emerald-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-emerald-700">{{ Auth::user()->email ?? '' }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-emerald-900 hover:bg-emerald-50 transition">
                                    <i class="fa-solid fa-user w-4"></i>
                                    <span>View Profile</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition text-left">
                                        <i class="fa-solid fa-right-from-bracket w-4"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="max-w-7xl mx-auto px-6 py-6">
            @yield('content')
        </section>
        <footer class="px-6 py-8 text-center text-sm text-emerald-800/70">
            <!-- Inspired by award-winning interfaces on <a href="https://www.awwwards.com/" target="_blank" class="underline hover:text-emerald-900">Awwwards</a>. Built for clarity and speed. -->
            &copy; {{ date('Y') }} Agriculture RMS - Department of Agriculture Claveria. All rights reserved.
        </footer>
    </main>

    @stack('scripts')
</body>

</html>