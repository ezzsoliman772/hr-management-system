<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') · ProductPulse HR</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        paper: '#EEF1F5',
                        ink: { 950: '#0B111C', 900: '#121A2B', 800: '#1B2740', 700: '#2A3A57', 500: '#5B6B8C', 300: '#9BA8C2' },
                        stamp: { DEFAULT: '#3556D6', dark: '#2740A8', light: '#E7ECFC' },
                        approve: { DEFAULT: '#1F7A53', light: '#E4F3EC' },
                        reject: { DEFAULT: '#B33A2E', light: '#FBEAE8' },
                        pending: { DEFAULT: '#C97A1F', light: '#FBF0DF' },
                    },
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                        mono: ['"IBM Plex Mono"', 'monospace'],
                    },
                    boxShadow: {
                        card: '0 1px 2px rgba(11,17,28,0.04), 0 1px 0 rgba(11,17,28,0.03)',
                    },
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .stamp { transform: rotate(-4deg); }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-paper text-ink-900 font-body antialiased">
<div class="min-h-full flex">

    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Main column --}}
    <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
        <x-topbar :title="trim($__env->yieldContent('title', 'Dashboard'))" :pending-count="$pendingCount ?? null" />

        <main class="flex-1 px-4 sm:px-6 lg:px-10 py-8">
            <div class="max-w-6xl mx-auto space-y-6">
                <x-alert />
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
