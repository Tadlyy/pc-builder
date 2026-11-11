<!DOCTYPE html>
<html lang="de" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PC Builder')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Apple System Fonts & Tailwind CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
                            surface: '#ffffff',
                            card: '#ffffff',
                            text: '#1d1d1f',
                            secondary: '#6e6e73',
                            tertiary: '#86868b',
                            blue: '#0071e3',
                            'blue-hover': '#0077ed',
                            border: 'rgba(0, 0, 0, 0.08)',
                            'border-subtle': 'rgba(0, 0, 0, 0.04)',
                            fill: '#f5f5f7',
                            'fill-hover': '#e8e8ed',
                            green: '#34c759',
                            red: '#ff3b30',
                            amber: '#ff9500',
                        }
                    },
                    boxShadow: {
                        'apple-sm': '0 2px 8px rgba(0, 0, 0, 0.04)',
                        'apple': '0 4px 20px rgba(0, 0, 0, 0.04)',
                        'apple-hover': '0 14px 34px rgba(0, 0, 0, 0.08)',
                        'apple-float': '0 20px 40px rgba(0, 0, 0, 0.07)',
                    }
                }
            }
        }
    </script>
    <style>
        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: -0.011em;
            scroll-behavior: smooth;
        }

        @keyframes appleFadeIn {
            0% {
                opacity: 0;
                transform: translateY(12px) scale(0.995);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fade-in-up {
            animation: appleFadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .apple-glass {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
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
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.28);
        }
    </style>
</head>
<body class="h-full bg-[#f5f5f7] text-[#1d1d1f] antialiased flex flex-col selection:bg-[#0071e3] selection:text-white">
    <!-- Apple Sleek Navigation -->
    <nav class="sticky top-0 z-50 apple-glass border-b border-black/[0.06] transition-all duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 items-center justify-between">
                <!-- Brand Logo -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2.5 transition active:scale-95">
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#1d1d1f] text-white shadow-sm transition-transform duration-300 group-hover:scale-105">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="4" y="4" width="16" height="16" rx="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="9" y="9" width="6" height="6" rx="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-[15px] font-semibold tracking-tight text-[#1d1d1f]">PC Builder</span>
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center gap-1 text-[13px]">
                        <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
                        <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
                        <x-nav-link :href="route('builds.public')">Builds entdecken</x-nav-link>
                    </div>
                </div>

                <!-- Right Nav (Auth / Actions) -->
                <div class="flex items-center gap-2.5 text-[13px]">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 font-medium text-[#1d1d1f] hover:bg-black/[0.05] transition active:scale-95">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-black/[0.08] text-[10px] font-bold text-[#1d1d1f]">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full border border-black/[0.08] bg-white px-3.5 py-1.5 font-medium text-[#6e6e73] hover:text-[#1d1d1f] hover:bg-zinc-50 hover:border-black/[0.15] transition active:scale-95 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                                Abmelden
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-3.5 py-1.5 font-medium text-[#1d1d1f] hover:bg-black/[0.04] transition active:scale-95">
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
        <div class="md:hidden border-t border-black/[0.04] bg-[#fbfbfd]/90 px-4 py-2 flex items-center justify-around text-xs">
            <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
            <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
            <x-nav-link :href="route('builds.public')">Builds</x-nav-link>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <!-- Apple-style Notifications -->
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-500/20 bg-emerald-50/80 px-4 py-3.5 text-sm text-emerald-900 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-white">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-500/20 bg-red-50/80 px-4 py-3.5 text-sm text-red-900 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-600 text-white">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('share_url'))
            <div class="mb-6 rounded-2xl border border-blue-500/20 bg-blue-50/80 p-4 text-sm text-blue-950 shadow-sm backdrop-blur-sm animate-fade-in-up">
                <div class="flex items-center gap-2 mb-2 font-medium text-blue-900">
                    <svg class="h-4 w-4 text-[#0071e3]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                    </svg>
                    <span>Dein öffentlicher Teilen-Link ist bereit:</span>
                </div>
                <div class="relative flex items-center">
                    <input type="text" readonly value="{{ session('share_url') }}"
                        class="w-full rounded-xl border border-blue-200/80 bg-white/90 px-3.5 py-2 text-xs font-mono text-blue-900 shadow-inner focus:outline-none focus:ring-2 focus:ring-[#0071e3]"
                        onclick="this.select()">
                    <span class="absolute right-3 text-[11px] font-medium text-[#0071e3] pointer-events-none">Klicken zum Kopieren</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Apple-style Minimal Footer -->
    <footer class="border-t border-black/[0.06] bg-[#f5f5f7] py-8 text-center text-xs text-[#86868b]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <p class="leading-relaxed">
                PC Builder Konfigurator · Entwickelt mit Laravel &amp; Blade · Intelligente Kompatibilitätsprüfung für CPU, Mainboard, RAM, GPU &amp; Netzteil
            </p>
            <p class="mt-2 text-[11px] text-[#a1a1a6]">
                Design inspiriert von Apple Minimalismus &amp; Clean Aesthetics · All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
