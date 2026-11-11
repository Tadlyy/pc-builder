<!DOCTYPE html>
<html lang="de" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PC Builder')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Apple Dark Mode Anti-Flicker Script -->
    <script>
        (function() {
            try {
                const storedTheme = localStorage.getItem('pc_builder_theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>

    <!-- Google Fonts & Tailwind CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: [
                            '-apple-system',
                            'BlinkMacSystemFont',
                            '"SF Pro Text"',
                            '"SF Pro Display"',
                            '"SF Pro"',
                            '"Plus Jakarta Sans"',
                            '"Helvetica Neue"',
                            'Helvetica',
                            'Arial',
                            'sans-serif'
                        ],
                    },
                    colors: {
                        apple: {
                            canvas: '#f5f5f7',
                            'canvas-dark': '#000000',
                            card: '#ffffff',
                            'card-dark': '#161618',
                            'card-elevated-dark': '#1c1c1e',
                            text: '#1d1d1f',
                            'text-dark': '#f5f5f7',
                            secondary: '#6e6e73',
                            'secondary-dark': '#a1a1a6',
                            tertiary: '#86868b',
                            blue: '#0071e3',
                            'blue-dark': '#2997ff',
                            'blue-hover': '#0077ed',
                            border: 'rgba(0, 0, 0, 0.08)',
                            'border-dark': 'rgba(255, 255, 255, 0.08)',
                            green: '#34c759',
                            red: '#ff3b30',
                            amber: '#ff9500',
                        }
                    },
                    boxShadow: {
                        'apple-sm': '0 2px 8px rgba(0, 0, 0, 0.04)',
                        'apple': '0 4px 24px rgba(0, 0, 0, 0.04)',
                        'apple-hover': '0 14px 34px rgba(0, 0, 0, 0.08)',
                        'apple-dark': '0 4px 30px rgba(0, 0, 0, 0.5)',
                        'apple-hover-dark': '0 16px 40px rgba(0, 0, 0, 0.7)',
                    }
                }
            }
        }
    </script>
    <style>
        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: -0.012em;
            scroll-behavior: smooth;
        }

        @keyframes appleFadeIn {
            0% {
                opacity: 0;
                transform: translateY(14px) scale(0.992);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fade-in-up {
            animation: appleFadeIn 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .apple-glass {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .dark .apple-glass {
            background: rgba(10, 10, 12, 0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        /* Apple smooth scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 9999px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.18);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.28);
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="h-full bg-[#f5f5f7] dark:bg-[#000000] text-[#1d1d1f] dark:text-[#f5f5f7] antialiased flex flex-col selection:bg-[#0071e3] selection:text-white transition-colors duration-300">
    <!-- Apple Sleek Frosted Glass Navigation -->
    <nav class="sticky top-0 z-50 apple-glass border-b border-black/[0.06] dark:border-white/[0.08] transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 items-center justify-between">
                <!-- Brand Logo & Nav Links -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2.5 transition active:scale-95">
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#1d1d1f] dark:bg-white text-white dark:text-[#1d1d1f] shadow-sm transition-transform duration-300 group-hover:scale-105">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="4" y="4" width="16" height="16" rx="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="9" y="9" width="6" height="6" rx="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-[15px] font-semibold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">PC Builder</span>
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center gap-1 text-[13px]">
                        <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
                        <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
                        <x-nav-link :href="route('builds.public')">Builds entdecken</x-nav-link>
                    </div>
                </div>

                <!-- Right Nav (Theme Toggle & Auth) -->
                <div class="flex items-center gap-2.5 text-[13px]">
                    <!-- Apple Dark Mode Switcher -->
                    <button id="theme-toggle" type="button" onclick="toggleTheme()"
                        aria-label="Design wechseln"
                        class="flex h-8 w-8 items-center justify-center rounded-full border border-black/[0.08] dark:border-white/[0.1] bg-white dark:bg-[#1c1c1e] text-[#1d1d1f] dark:text-[#f5f5f7] shadow-sm hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all duration-200 active:scale-95">
                        <!-- Moon Icon (shown in light mode) -->
                        <svg id="theme-moon-icon" class="h-4 w-4 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sun Icon (shown in dark mode) -->
                        <svg id="theme-sun-icon" class="h-4 w-4 hidden dark:block text-amber-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                        </svg>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 font-medium text-[#1d1d1f] dark:text-[#f5f5f7] hover:bg-black/[0.05] dark:hover:bg-white/[0.08] transition active:scale-95">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-black/[0.08] dark:bg-white/[0.12] text-[10px] font-bold text-[#1d1d1f] dark:text-[#f5f5f7]">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full border border-black/[0.08] dark:border-white/[0.1] bg-white dark:bg-[#1c1c1e] px-3.5 py-1.5 font-medium text-[#6e6e73] dark:text-[#a1a1a6] hover:text-[#1d1d1f] dark:hover:text-white hover:bg-zinc-50 dark:hover:bg-zinc-800 transition active:scale-95 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                                Abmelden
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-3.5 py-1.5 font-medium text-[#1d1d1f] dark:text-[#f5f5f7] hover:bg-black/[0.04] dark:hover:bg-white/[0.08] transition active:scale-95">
                            Anmelden
                        </a>
                        <a href="{{ route('register') }}" class="rounded-full bg-[#0071e3] px-4 py-1.5 font-medium text-white shadow-sm hover:bg-[#0077ed] transition active:scale-95 hover:shadow">
                            Registrieren
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden border-t border-black/[0.04] dark:border-white/[0.06] bg-[#fbfbfd]/90 dark:bg-[#0a0a0c]/90 px-4 py-2 flex items-center justify-around text-xs">
            <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
            <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
            <x-nav-link :href="route('builds.public')">Builds</x-nav-link>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <!-- Apple-style Notifications (Light & Dark) -->
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-500/20 dark:border-emerald-500/30 bg-emerald-50/80 dark:bg-emerald-950/30 px-4 py-3.5 text-sm text-emerald-900 dark:text-emerald-300 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 dark:bg-emerald-500 text-white">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-500/20 dark:border-red-500/30 bg-red-50/80 dark:bg-red-950/30 px-4 py-3.5 text-sm text-red-900 dark:text-red-300 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-600 dark:bg-red-500 text-white">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('share_url'))
            <div class="mb-6 rounded-2xl border border-blue-500/20 dark:border-blue-500/30 bg-blue-50/80 dark:bg-blue-950/30 p-4 text-sm text-blue-950 dark:text-blue-200 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex items-center gap-2 mb-2 font-medium text-blue-900 dark:text-blue-300">
                    <svg class="h-4 w-4 text-[#0071e3] dark:text-[#2997ff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    <span>Dein öffentlicher Teilen-Link ist bereit:</span>
                </div>
                <div class="relative flex items-center">
                    <input type="text" readonly value="{{ session('share_url') }}"
                        class="w-full rounded-xl border border-blue-200/80 dark:border-blue-500/30 bg-white/90 dark:bg-[#161618] px-3.5 py-2 text-xs font-mono text-blue-900 dark:text-blue-200 shadow-inner focus:outline-none focus:ring-2 focus:ring-[#0071e3]"
                        onclick="this.select()">
                    <span class="absolute right-3 text-[11px] font-medium text-[#0071e3] dark:text-[#2997ff] pointer-events-none">Klicken zum Kopieren</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Apple-style Minimal Footer (Light & Dark) -->
    <footer class="border-t border-black/[0.06] dark:border-white/[0.08] bg-[#f5f5f7] dark:bg-[#0a0a0c] py-8 text-center text-xs text-[#86868b] dark:text-[#737378] transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <p class="leading-relaxed">
                PC Builder Konfigurator · Entwickelt mit Laravel &amp; Blade · Automatische Kompatibilitätsprüfung für CPU, Mainboard, RAM, GPU &amp; Netzteil
            </p>
            <p class="mt-2 text-[11px] text-[#a1a1a6] dark:text-[#525257]">
                Design inspiriert von Apple Minimalismus · Light &amp; Dark Mode · All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Theme Toggle Function -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('pc_builder_theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('pc_builder_theme', 'dark');
            }
        }
    </script>
</body>
</html>
