<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign in') · ProductPulse HR</title>

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
                }
            }
        }
    </script>
</head>
<body class="h-full bg-paper text-ink-900 font-body antialiased">
<div class="min-h-full grid lg:grid-cols-2">

    {{-- Branding panel --}}
    <div class="hidden lg:flex flex-col justify-between bg-ink-900 text-white px-14 py-12 relative overflow-hidden">
        <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full border border-white/5"></div>
        <div class="absolute -right-10 top-32 w-72 h-72 rounded-full border border-white/5"></div>

        <a href="{{ url('/') }}" class="font-display font-semibold text-xl tracking-tight relative">
            ProductPulse <span class="text-stamp-light font-normal opacity-80">HR</span>
        </a>

        <div class="relative">
            <span class="stamp inline-flex items-center px-3 py-1 rounded-md border-2 border-dashed border-approve text-approve font-display text-[11px] font-bold uppercase tracking-[0.12em] mb-6">Approved</span>
            <h2 class="font-display font-semibold text-4xl leading-[1.1] max-w-sm">Time off,<br>tracked to the day.</h2>
            <p class="text-ink-300 mt-4 max-w-sm text-[15px] leading-relaxed">Every request, balance, and approval — logged in one ledger your whole team can trust.</p>
        </div>

        <div class="relative flex items-center gap-6 font-mono text-xs text-ink-500 uppercase tracking-wider">
            <span>Requests</span>
            <span class="w-1 h-1 rounded-full bg-ink-700"></span>
            <span>Balances</span>
            <span class="w-1 h-1 rounded-full bg-ink-700"></span>
            <span>Approvals</span>
        </div>
    </div>

    {{-- Form panel --}}
    <div class="flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-sm">
            <div class="lg:hidden mb-8">
                <span class="font-display font-semibold text-xl text-ink-950 tracking-tight">ProductPulse <span class="text-stamp font-normal">HR</span></span>
            </div>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
