<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ENADE+') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ── Floating Math Symbols ── */
            @keyframes sym-float {
                0%   { transform: translateY(110vh) rotate(-6deg) scale(0.8);  opacity: 0; }
                6%   { opacity: 1; }
                82%  { opacity: 1; }
                100% { transform: translateY(-120vh) rotate( 8deg) scale(1.1); opacity: 0; }
            }
            .sym {
                position: absolute;
                bottom: 0;
                animation-name: sym-float;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
                font-family: 'Courier New', Courier, monospace;
                font-weight: 700;
                line-height: 1;
                pointer-events: none;
                user-select: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-100/80">

        {{-- ══ FLOATING MATH SYMBOLS BACKGROUND ══
             indigo-600 = rgb(79 70 229)  |  violet-600 = rgb(124 58 237)
             Edges/sides: .25  |  Centre (behind cards): .15
             ~65 symbols — animation travels 110vh→-120vh (full screen + above) --}}
        <div id="particles" class="fixed inset-0 overflow-hidden pointer-events-none select-none" style="z-index:0;" aria-hidden="true">

            {{-- ── LEFT EDGE (0–15%) — 12 symbols ── --}}
            <span class="sym" style="left:1%;  font-size:1.4rem; color:rgb(79  70 229/.25); animation-duration:30s; animation-delay:-4s;">π</span>
            <span class="sym" style="left:3%;  font-size:1.8rem; color:rgb(124 58 237/.25); animation-duration:36s; animation-delay:-19s;">{}</span>
            <span class="sym" style="left:6%;  font-size:1.1rem; color:rgb(79  70 229/.25); animation-duration:24s; animation-delay:-9s;">√</span>
            <span class="sym" style="left:8%;  font-size:1.6rem; color:rgb(124 58 237/.25); animation-duration:33s; animation-delay:-27s;">λ</span>
            <span class="sym" style="left:11%; font-size:1.0rem; color:rgb(79  70 229/.25); animation-duration:21s; animation-delay:-14s;">fn</span>
            <span class="sym" style="left:13%; font-size:1.3rem; color:rgb(124 58 237/.25); animation-duration:28s; animation-delay:-32s;">01</span>
            <span class="sym" style="left:2%;  font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:40s; animation-delay:-22s;">&lt;&gt;</span>
            <span class="sym" style="left:9%;  font-size:1.5rem; color:rgb(124 58 237/.25); animation-duration:26s; animation-delay:-6s;">∑</span>
            <span class="sym" style="left:4%;  font-size:1.3rem; color:rgb(79  70 229/.25); animation-duration:18s; animation-delay:-41s;">Ω</span>
            <span class="sym" style="left:7%;  font-size:1.1rem; color:rgb(124 58 237/.25); animation-duration:15s; animation-delay:-7s;">++</span>
            <span class="sym" style="left:12%; font-size:1.4rem; color:rgb(79  70 229/.25); animation-duration:44s; animation-delay:-35s;">∂</span>
            <span class="sym" style="left:5%;  font-size:1.0rem; color:rgb(124 58 237/.25); animation-duration:20s; animation-delay:-51s;">::</span>

            {{-- ── LEFT-CENTRE (16–33%) — 10 symbols ── --}}
            <span class="sym" style="left:18%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:27s; animation-delay:-11s;">===</span>
            <span class="sym" style="left:22%; font-size:1.4rem; color:rgb(124 58 237/.25); animation-duration:31s; animation-delay:-38s;">∞</span>
            <span class="sym" style="left:26%; font-size:1.1rem; color:rgb(79  70 229/.25); animation-duration:23s; animation-delay:-16s;">||</span>
            <span class="sym" style="left:30%; font-size:1.3rem; color:rgb(124 58 237/.25); animation-duration:35s; animation-delay:-7s;">=&gt;</span>
            <span class="sym" style="left:20%; font-size:1.0rem; color:rgb(79  70 229/.25); animation-duration:29s; animation-delay:-25s;">if</span>
            <span class="sym" style="left:16%; font-size:1.5rem; color:rgb(124 58 237/.25); animation-duration:38s; animation-delay:-43s;">∇</span>
            <span class="sym" style="left:24%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:17s; animation-delay:-9s;">±</span>
            <span class="sym" style="left:28%; font-size:1.0rem; color:rgb(124 58 237/.25); animation-duration:32s; animation-delay:-57s;">var</span>
            <span class="sym" style="left:19%; font-size:1.3rem; color:rgb(79  70 229/.25); animation-duration:45s; animation-delay:-48s;">μ</span>
            <span class="sym" style="left:31%; font-size:1.1rem; color:rgb(124 58 237/.25); animation-duration:22s; animation-delay:-30s;">10</span>

            {{-- ── CENTRE (34–66%) — 12 symbols, slightly more subtle ── --}}
            <span class="sym" style="left:36%; font-size:1.5rem; color:rgb(79  70 229/.15); animation-duration:34s; animation-delay:-13s;">Δ</span>
            <span class="sym" style="left:41%; font-size:1.2rem; color:rgb(124 58 237/.15); animation-duration:22s; animation-delay:-3s;">[]</span>
            <span class="sym" style="left:46%; font-size:1.6rem; color:rgb(79  70 229/.15); animation-duration:38s; animation-delay:-29s;">∫</span>
            <span class="sym" style="left:52%; font-size:1.1rem; color:rgb(124 58 237/.15); animation-duration:26s; animation-delay:-18s;">()</span>
            <span class="sym" style="left:58%; font-size:1.4rem; color:rgb(79  70 229/.15); animation-duration:31s; animation-delay:-8s;">θ</span>
            <span class="sym" style="left:63%; font-size:1.2rem; color:rgb(124 58 237/.15); animation-duration:24s; animation-delay:-34s;">≤</span>
            <span class="sym" style="left:48%; font-size:1.0rem; color:rgb(79  70 229/.15); animation-duration:42s; animation-delay:-20s;">*</span>
            <span class="sym" style="left:38%; font-size:1.0rem; color:rgb(124 58 237/.15); animation-duration:19s; animation-delay:-45s;">let</span>
            <span class="sym" style="left:55%; font-size:1.3rem; color:rgb(79  70 229/.15); animation-duration:37s; animation-delay:-60s;">σ</span>
            <span class="sym" style="left:44%; font-size:1.0rem; color:rgb(124 58 237/.15); animation-duration:25s; animation-delay:-37s;">for</span>
            <span class="sym" style="left:61%; font-size:1.1rem; color:rgb(79  70 229/.15); animation-duration:43s; animation-delay:-52s;">≥</span>
            <span class="sym" style="left:35%; font-size:1.0rem; color:rgb(124 58 237/.15); animation-duration:20s; animation-delay:-28s;">0x</span>

            {{-- ── RIGHT-CENTRE (67–83%) — 10 symbols ── --}}
            <span class="sym" style="left:68%; font-size:1.3rem; color:rgb(124 58 237/.25); animation-duration:27s; animation-delay:-15s;">φ</span>
            <span class="sym" style="left:72%; font-size:1.1rem; color:rgb(79  70 229/.25); animation-duration:30s; animation-delay:-5s;">π</span>
            <span class="sym" style="left:76%; font-size:1.4rem; color:rgb(124 58 237/.25); animation-duration:23s; animation-delay:-37s;">≠</span>
            <span class="sym" style="left:80%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:35s; animation-delay:-12s;">!=</span>
            <span class="sym" style="left:70%; font-size:1.0rem; color:rgb(124 58 237/.25); animation-duration:28s; animation-delay:-23s;">#</span>
            <span class="sym" style="left:65%; font-size:1.5rem; color:rgb(79  70 229/.25); animation-duration:36s; animation-delay:-42s;">∫</span>
            <span class="sym" style="left:74%; font-size:1.0rem; color:rgb(124 58 237/.25); animation-duration:16s; animation-delay:-8s;">let</span>
            <span class="sym" style="left:78%; font-size:1.3rem; color:rgb(79  70 229/.25); animation-duration:41s; animation-delay:-55s;">σ</span>
            <span class="sym" style="left:67%; font-size:1.1rem; color:rgb(124 58 237/.25); animation-duration:19s; animation-delay:-33s;">&amp;&amp;</span>
            <span class="sym" style="left:82%; font-size:1.4rem; color:rgb(79  70 229/.25); animation-duration:47s; animation-delay:-18s;">∂</span>

            {{-- ── RIGHT EDGE (84–100%) — 12 symbols ── --}}
            <span class="sym" style="left:85%; font-size:1.6rem; color:rgb(79  70 229/.25); animation-duration:33s; animation-delay:-10s;">∑</span>
            <span class="sym" style="left:88%; font-size:1.8rem; color:rgb(124 58 237/.25); animation-duration:29s; animation-delay:-2s;">{}</span>
            <span class="sym" style="left:91%; font-size:1.3rem; color:rgb(79  70 229/.25); animation-duration:26s; animation-delay:-30s;">√</span>
            <span class="sym" style="left:94%; font-size:1.4rem; color:rgb(124 58 237/.25); animation-duration:38s; animation-delay:-17s;">∞</span>
            <span class="sym" style="left:97%; font-size:1.5rem; color:rgb(79  70 229/.25); animation-duration:22s; animation-delay:-7s;">∫</span>
            <span class="sym" style="left:99%; font-size:1.1rem; color:rgb(124 58 237/.25); animation-duration:31s; animation-delay:-24s;">Δ</span>
            <span class="sym" style="left:86%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:36s; animation-delay:-40s;">10</span>
            <span class="sym" style="left:93%; font-size:1.4rem; color:rgb(124 58 237/.25); animation-duration:25s; animation-delay:-13s;">@</span>
            <span class="sym" style="left:89%; font-size:1.0rem; color:rgb(79  70 229/.25); animation-duration:43s; animation-delay:-33s;">&amp;&amp;</span>
            <span class="sym" style="left:95%; font-size:1.3rem; color:rgb(124 58 237/.25); animation-duration:17s; animation-delay:-52s;">λ</span>
            <span class="sym" style="left:87%; font-size:1.5rem; color:rgb(79  70 229/.25); animation-duration:39s; animation-delay:-21s;">Ω</span>
            <span class="sym" style="left:98%; font-size:1.1rem; color:rgb(124 58 237/.25); animation-duration:15s; animation-delay:-44s;">::</span>

            {{-- ── EXTRA GAP-FILLERS (sides + transitions) ── --}}
            <span class="sym" style="left:15%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:32s; animation-delay:-58s;">≥</span>
            <span class="sym" style="left:83%; font-size:1.2rem; color:rgb(124 58 237/.25); animation-duration:28s; animation-delay:-47s;">++</span>
            <span class="sym" style="left:33%; font-size:1.3rem; color:rgb(79  70 229/.20); animation-duration:46s; animation-delay:-36s;">∇</span>
            <span class="sym" style="left:64%; font-size:1.3rem; color:rgb(124 58 237/.20); animation-duration:34s; animation-delay:-26s;">μ</span>
            <span class="sym" style="left:73%; font-size:1.2rem; color:rgb(79  70 229/.25); animation-duration:37s; animation-delay:-11s;">±</span>
            <span class="sym" style="left:5%;  font-size:0.9rem; color:rgb(124 58 237/.25); animation-duration:50s; animation-delay:-47s;">1010</span>
            <span class="sym" style="left:96%; font-size:0.9rem; color:rgb(79  70 229/.25); animation-duration:21s; animation-delay:-39s;">for</span>

        </div>
        {{-- ══ END FLOATING SYMBOLS ══ --}}

        {{-- Fixed Navbar (z-50 — already above the symbols) --}}
        @include('layouts.navigation')

        {{-- Spacer for fixed navbar --}}
        <div class="h-24"></div>

        <!-- Page Heading -->
        @isset($header)
            <header class="relative z-10 bg-white/80 backdrop-blur-sm border-b border-slate-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content (z-10 so cards sit above the symbols) -->
        <main class="relative z-10 bg-transparent">
            {{ $slot }}
        </main>
    </body>
</html>
