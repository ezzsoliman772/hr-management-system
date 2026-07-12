<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductPulse HR — Leave management, without the spreadsheet</title>
    <meta name="description" content="Employees request time off, admins approve it, balances update themselves. One place for your whole team's leave.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: { 950: '#0E1224', 900: '#151A33', 700: '#3A4166', 500: '#6B7290' },
                        indigo: { 50: '#EEF0FD', 100: '#E0E4FB', 500: '#4F46E5', 600: '#4338CA', 700: '#372FA6' },
                        skyblue: { 500: '#2563EB', 400: '#3B82F6' },
                    },
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="font-body text-ink-900 bg-white antialiased">

@php
    $dashboardRoute = null;
    if (auth()->check()) {
        $dashboardRoute = (auth()->user()->role ?? null) === 'admin' ? route('admin.dashboard') : route('employee.dashboard');
    }
@endphp

{{-- ============ NAV ============ --}}
<header class="sticky top-0 z-30 bg-white/85 backdrop-blur border-b border-ink-950/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-18 py-4 flex items-center justify-between">
        <a href="{{ url('/') }}" class="font-display font-semibold text-lg tracking-tight text-ink-950">
            Product<span class="text-indigo-500">Pulse</span> <span class="text-ink-500 font-medium text-base">HR</span>
        </a>

        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-ink-700">
            <a href="#features" class="hover:text-ink-950 transition-colors">Features</a>
            <a href="#how-it-works" class="hover:text-ink-950 transition-colors">How it works</a>
            <a href="#benefits" class="hover:text-ink-950 transition-colors">Benefits</a>
        </nav>

        <div class="flex items-center gap-3">
            @if($dashboardRoute)
                <a href="{{ $dashboardRoute }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-indigo-500 text-white text-sm font-semibold px-4 py-2.5 hover:bg-indigo-600 transition-colors">
                    Go to Dashboard
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-ink-700 hover:text-ink-950 px-3 py-2.5 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center rounded-lg bg-indigo-500 text-white text-sm font-semibold px-4 py-2.5 hover:bg-indigo-600 transition-colors">
                    Register
                </a>
            @endif
        </div>
    </div>
</header>

{{-- ============ HERO ============ --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/70 to-white -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-20 lg:pt-24 lg:pb-28 grid lg:grid-cols-2 gap-14 items-center">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1.5 tracking-wide uppercase">
                Leave management, simplified
            </span>

            <h1 class="font-display font-semibold text-4xl sm:text-5xl lg:text-[3.25rem] leading-[1.1] text-ink-950 mt-5">
                Time off,<br> handled properly.
            </h1>

            <p class="text-ink-500 text-lg leading-relaxed mt-5 max-w-md">
                ProductPulse HR is where your team requests leave, admins review it, and
                balances update themselves — no spreadsheet, no email chains.
            </p>

            <div class="flex flex-wrap items-center gap-3 mt-8">
                @if($dashboardRoute)
                    <a href="{{ $dashboardRoute }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-500 text-white text-sm font-semibold px-6 py-3.5 hover:bg-indigo-600 transition-colors">
                        Go to Dashboard
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center rounded-lg border border-ink-950/12 text-ink-900 text-sm font-semibold px-6 py-3.5 hover:border-ink-950/25 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-500 text-white text-sm font-semibold px-6 py-3.5 hover:bg-indigo-600 transition-colors">
                        Register
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-6 mt-10 text-sm text-ink-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
                    Employee &amp; Admin panels
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
                    Balances update automatically
                </div>
            </div>
        </div>

        {{-- Hero illustration — pure SVG, no external assets --}}
        <div class="relative">
            <svg viewBox="0 0 560 480" class="w-full h-auto max-w-lg mx-auto" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="cardHeader" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#4F46E5"/>
                        <stop offset="100%" stop-color="#2563EB"/>
                    </linearGradient>
                    <linearGradient id="stampGrad" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#4338CA"/>
                        <stop offset="100%" stop-color="#3B82F6"/>
                    </linearGradient>
                </defs>

                <circle cx="120" cy="90" r="110" fill="#4F46E5" opacity="0.06"/>
                <circle cx="470" cy="380" r="140" fill="#2563EB" opacity="0.06"/>
                <circle cx="480" cy="70" r="6" fill="#4F46E5" opacity="0.4"/>
                <circle cx="500" cy="120" r="4" fill="#2563EB" opacity="0.4"/>
                <circle cx="60" cy="360" r="5" fill="#4F46E5" opacity="0.35"/>

                <!-- Small calendar card, back layer -->
                <g transform="translate(70,150) rotate(-6)">
                    <rect width="150" height="150" rx="16" fill="white" stroke="#E7E9F7" stroke-width="2"/>
                    <rect width="150" height="34" rx="16" fill="#EEF0FD"/>
                    <rect width="150" height="18" fill="#EEF0FD"/>
                    <g fill="#C7CCF0">
                        <circle cx="28" cy="60" r="5"/><circle cx="55" cy="60" r="5"/><circle cx="82" cy="60" r="5"/><circle cx="109" cy="60" r="5"/><circle cx="136" cy="60" r="5"/>
                        <circle cx="28" cy="82" r="5"/><circle cx="55" cy="82" r="5"/><circle cx="109" cy="82" r="5"/><circle cx="136" cy="82" r="5"/>
                        <circle cx="28" cy="104" r="5"/><circle cx="55" cy="104" r="5"/><circle cx="82" cy="104" r="5"/><circle cx="136" cy="104" r="5"/>
                    </g>
                    <circle cx="82" cy="82" r="9" fill="#4F46E5"/>
                </g>

                <!-- Main leave request card, front layer -->
                <g transform="translate(190,110)">
                    <rect width="300" height="230" rx="20" fill="white" stroke="#E7E9F7" stroke-width="2"/>
                    <rect width="300" height="56" rx="20" fill="url(#cardHeader)"/>
                    <rect width="300" height="28" fill="url(#cardHeader)"/>
                    <text x="24" y="34" font-family="Inter, sans-serif" font-size="15" font-weight="600" fill="white">Leave request</text>
                    <circle cx="270" cy="28" r="12" fill="white" opacity="0.15"/>
                    <path d="M264 28h12M270 22v12" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.9"/>

                    <rect x="24" y="80" width="90" height="10" rx="5" fill="#DADFF9"/>
                    <rect x="24" y="98" width="130" height="16" rx="4" fill="#151A33" opacity="0.85"/>

                    <rect x="170" y="80" width="70" height="10" rx="5" fill="#DADFF9"/>
                    <rect x="170" y="98" width="106" height="16" rx="4" fill="#151A33" opacity="0.85"/>

                    <rect x="24" y="134" width="60" height="10" rx="5" fill="#DADFF9"/>
                    <rect x="24" y="152" width="252" height="12" rx="4" fill="#E7E9F7"/>
                    <rect x="24" y="170" width="200" height="12" rx="4" fill="#E7E9F7"/>

                    <rect x="24" y="196" width="110" height="18" rx="9" fill="#EEF0FD"/>
                    <text x="79" y="209" text-anchor="middle" font-family="Inter, sans-serif" font-size="10" font-weight="700" fill="#4338CA" letter-spacing="1">PENDING</text>
                </g>

                <!-- Stamp -->
                <g transform="translate(410,290) rotate(-10)">
                    <circle cx="0" cy="0" r="58" fill="white" stroke="url(#stampGrad)" stroke-width="3.5" stroke-dasharray="7 7"/>
                    <circle cx="0" cy="0" r="42" fill="#EEF0FD"/>
                    <path d="M-16 0l11 12 21-26" stroke="#4338CA" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    <text x="0" y="46" text-anchor="middle" font-family="'Space Grotesk', sans-serif" font-size="13" font-weight="700" fill="#4338CA" letter-spacing="1.5">APPROVED</text>
                </g>
            </svg>
        </div>
    </div>
</section>

{{-- ============ FEATURES ============ --}}
<section id="features" class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-24">
    <div class="max-w-xl">
        <span class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-500">Features</span>
        <h2 class="font-display font-semibold text-3xl sm:text-4xl text-ink-950 mt-3">Everything leave tracking needs — nothing it doesn't.</h2>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-12">
        @php
            $features = [
                ['title' => 'Leave Request Management', 'desc' => 'Employees submit start and end dates with a reason, in one short form.', 'icon' => 'calendar'],
                ['title' => 'Employee Dashboard', 'desc' => 'A clear view of remaining balance, pending requests, and request history.', 'icon' => 'grid'],
                ['title' => 'Admin Dashboard', 'desc' => 'Every request across the team, ready to review from a single screen.', 'icon' => 'shield'],
                ['title' => 'Automatic Leave Balance Tracking', 'desc' => 'Approving a request deducts days from the balance instantly — no manual math.', 'icon' => 'trend'],
                ['title' => 'Approval Workflow', 'desc' => 'A simple pending → approved / rejected flow admins control end to end.', 'icon' => 'check'],
            ];
        @endphp

        @foreach ($features as $f)
            <div class="rounded-2xl border border-ink-950/8 p-6 hover:shadow-lg hover:shadow-indigo-500/5 hover:-translate-y-0.5 transition-all">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    @switch($f['icon'])
                        @case('calendar')
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="5" width="17" height="15" rx="2.5"/><path stroke-linecap="round" d="M3.5 9.5h17M8 3v4M16 3v4"/></svg>
                            @break
                        @case('grid')
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="3.5" width="7" height="7" rx="1.3"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.3"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.3"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.3"/></svg>
                            @break
                        @case('shield')
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3.5 5 6v6c0 4.5 3 7.4 7 8.5 4-1.1 7-4 7-8.5V6l-7-2.5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9.3 12 1.9 2 3.5-4.2"/></svg>
                            @break
                        @case('trend')
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16.5 9.5 11l4 4L20 7"/><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 7H20v5.5"/></svg>
                            @break
                        @case('check')
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12 2.5 2.5 4.5-5"/></svg>
                            @break
                    @endswitch
                </div>
                <h3 class="font-display font-semibold text-base text-ink-950 mt-4">{{ $f['title'] }}</h3>
                <p class="text-sm text-ink-500 leading-relaxed mt-1.5">{{ $f['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ HOW IT WORKS ============ --}}
<section id="how-it-works" class="bg-indigo-50/60 border-y border-ink-950/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-24">
        <div class="max-w-xl">
            <span class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-500">How it works</span>
            <h2 class="font-display font-semibold text-3xl sm:text-4xl text-ink-950 mt-3">Four steps, start to finish.</h2>
        </div>

        <div class="grid md:grid-cols-4 gap-6 lg:gap-4 mt-14 relative">
            @php
                $steps = [
                    ['n' => '01', 'title' => 'Employee submits request', 'desc' => 'Start date, end date, and a reason — submitted in under a minute.'],
                    ['n' => '02', 'title' => 'Admin reviews', 'desc' => 'The request lands on the admin dashboard alongside everyone else\'s.'],
                    ['n' => '03', 'title' => 'Approve / Reject', 'desc' => 'One click moves the request out of pending, for good.'],
                    ['n' => '04', 'title' => 'Balance updates automatically', 'desc' => 'Approved days are deducted from the balance immediately.'],
                ];
            @endphp

            @foreach ($steps as $i => $step)
                <div class="relative bg-white rounded-2xl border border-ink-950/8 p-6">
                    <span class="font-display text-xs font-bold text-indigo-500 tracking-widest">{{ $step['n'] }}</span>
                    <h3 class="font-display font-semibold text-base text-ink-950 mt-3">{{ $step['title'] }}</h3>
                    <p class="text-sm text-ink-500 leading-relaxed mt-1.5">{{ $step['desc'] }}</p>

                    @if(!$loop->last)
                        <svg class="hidden md:block absolute top-1/2 -right-5 -translate-y-1/2 w-4 h-4 text-indigo-300 z-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6"/></svg>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ BENEFITS ============ --}}
<section id="benefits" class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-24">
    <div class="grid lg:grid-cols-2 gap-14 items-center">
        <div>
            <span class="text-xs font-semibold uppercase tracking-[0.14em] text-indigo-500">Benefits</span>
            <h2 class="font-display font-semibold text-3xl sm:text-4xl text-ink-950 mt-3 leading-tight">
                Less back-and-forth.<br>More time actually off.
            </h2>
            <p class="text-ink-500 leading-relaxed mt-4 max-w-md">
                Replacing spreadsheets and email threads with one shared source of truth means fewer
                mistakes and fewer "wait, how many days do I have left?" messages.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            @php
                $benefits = [
                    ['title' => 'No more spreadsheets', 'desc' => 'One system replaces scattered trackers and manual balance math.'],
                    ['title' => 'Always up to date', 'desc' => 'Balances reflect approvals the moment they happen.'],
                    ['title' => 'Clear for everyone', 'desc' => 'Employees see their own status; admins see the full picture.'],
                    ['title' => 'Fewer errors', 'desc' => 'Automatic deductions remove manual, error-prone bookkeeping.'],
                ];
            @endphp
            @foreach ($benefits as $b)
                <div class="rounded-2xl bg-white border border-ink-950/8 p-5">
                    <svg class="w-5 h-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
                    <h3 class="font-display font-semibold text-sm text-ink-950 mt-3">{{ $b['title'] }}</h3>
                    <p class="text-xs text-ink-500 leading-relaxed mt-1">{{ $b['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ CTA ============ --}}
<section class="max-w-7xl mx-auto px-6 lg:px-8 pb-20 lg:pb-24">
    <div class="rounded-3xl bg-gradient-to-br from-indigo-600 to-skyblue-500 px-8 py-14 sm:px-16 sm:py-16 text-center relative overflow-hidden">
        <div class="absolute -top-10 -left-10 w-56 h-56 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-16 -right-10 w-64 h-64 rounded-full bg-white/10"></div>
        <h2 class="font-display font-semibold text-3xl sm:text-4xl text-white relative">Ready to see your balance?</h2>
        <p class="text-indigo-100 mt-3 max-w-md mx-auto relative">
            @if($dashboardRoute)
                Head back to your dashboard to submit or review requests.
            @else
                Create an account and your leave allowance is set up by HR from day one.
            @endif
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 mt-8 relative">
            @if($dashboardRoute)
                <a href="{{ $dashboardRoute }}" class="inline-flex items-center gap-2 rounded-lg bg-white text-indigo-600 text-sm font-semibold px-6 py-3.5 hover:bg-indigo-50 transition-colors">
                    Go to Dashboard
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-lg bg-white text-indigo-600 text-sm font-semibold px-6 py-3.5 hover:bg-indigo-50 transition-colors">
                    Register
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-lg border border-white/40 text-white text-sm font-semibold px-6 py-3.5 hover:bg-white/10 transition-colors">
                    Login
                </a>
            @endif
        </div>
    </div>
</section>

{{-- ============ FOOTER ============ --}}
<footer class="border-t border-ink-950/8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="font-display font-semibold text-ink-950 tracking-tight">
            Product<span class="text-indigo-500">Pulse</span> <span class="text-ink-500 font-medium">HR</span>
        </a>
        <nav class="flex items-center gap-6 text-sm text-ink-500">
            <a href="#features" class="hover:text-ink-950 transition-colors">Features</a>
            <a href="#how-it-works" class="hover:text-ink-950 transition-colors">How it works</a>
            <a href="#benefits" class="hover:text-ink-950 transition-colors">Benefits</a>
        </nav>
        <p class="text-sm text-ink-500">&copy; {{ date('Y') }} ProductPulse HR. All rights reserved.</p>
    </div>
</footer>

</body>
</html>