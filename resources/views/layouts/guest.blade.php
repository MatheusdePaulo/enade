<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ENADE+') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-slate-100">

<div class="min-h-screen flex">

    {{-- ── PAINEL ESQUERDO (visível em lg+) ── --}}
    <div class="hidden lg:flex lg:w-1/2 xl:w-5/12 relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 flex-col justify-between overflow-hidden">

        {{-- Círculos decorativos --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/10 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-violet-600/10 rounded-full translate-y-24 -translate-x-24 blur-3xl"></div>

        {{-- Símbolos flutuantes sutis --}}
        @php
            $symbols = ['π','{}','√','λ','∑','∞','Δ','∫','θ','≠','⟹','&&','[]','()'];
            $positions = [
                ['top:8%','left:5%','1.2rem','0.08'],['top:20%','left:80%','1.0rem','0.06'],
                ['top:35%','left:12%','1.4rem','0.07'],['top:50%','left:75%','1.1rem','0.08'],
                ['top:65%','left:8%','1.0rem','0.06'],['top:78%','left:82%','1.3rem','0.07'],
                ['top:90%','left:20%','1.1rem','0.08'],['top:15%','left:45%','0.9rem','0.05'],
            ];
        @endphp
        @foreach($positions as $i => $pos)
            <span class="absolute font-mono font-bold pointer-events-none select-none text-indigo-300"
                  style="top:{{ $pos[0] }};left:{{ $pos[1] }};font-size:{{ $pos[2] }};opacity:{{ $pos[3] }}">
                {{ $symbols[$i % count($symbols)] }}
            </span>
        @endforeach

        {{-- Conteúdo --}}
        <div class="relative z-10 px-12 pt-12">
            <a href="/" class="inline-block">
                <img src="{{ asset('images/logo-wel.png') }}" alt="Logo" class="h-16 w-auto object-contain drop-shadow-lg">
            </a>
        </div>

        <div class="relative z-10 px-12 py-16">
            <h2 class="text-3xl font-extrabold text-white leading-tight mb-4">
                Prepare-se para o<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">ENADE com confiança.</span>
            </h2>
            <p class="text-slate-400 text-base leading-relaxed mb-8">
                Banco de questões reais, simulados cronometrados e gabarito comentado — tudo para você ir além na prova.
            </p>
            <div class="space-y-3">
                @foreach(['Questões reais do ENADE por área', 'Simulado com cronômetro e resultado detalhado', 'Gabarito comentado em cada questão'] as $item)
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        <div class="w-5 h-5 bg-indigo-500/20 rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        {{ $item }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="relative z-10 px-12 pb-8 text-xs text-slate-600">
            &copy; {{ date('Y') }} ENADE+. Todos os direitos reservados.
        </div>
    </div>

    {{-- ── PAINEL DIREITO (formulário) ── --}}
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white lg:px-12 xl:px-16">

        {{-- Logo mobile --}}
        <div class="lg:hidden mb-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto object-contain mx-auto">
            </a>
        </div>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

        <p class="mt-8 text-xs text-slate-400 text-center lg:hidden">
            &copy; {{ date('Y') }} ENADE+. Todos os direitos reservados.
        </p>
    </div>

</div>
</body>
</html>
