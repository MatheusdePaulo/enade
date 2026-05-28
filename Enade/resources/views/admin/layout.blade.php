<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — {{ config('app.name', 'ENADE+') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-zinc-950 text-slate-100">

<div class="flex min-h-screen">

    {{-- ── SIDEBAR ─────────────────────────────────────────── --}}
    <aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-40">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-800">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div class="leading-tight">
                <p class="text-white font-bold text-sm">Painel Admin</p>
                <p class="text-slate-500 text-xs">ENADE+</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">

            {{-- Painel --}}
            @php $active = request()->routeIs('admin.dashboard'); @endphp
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ $active ? 'bg-indigo-600/20 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Painel</span>
            </a>

            {{-- Nova Questão --}}
            @php $active = request()->routeIs('admin.questions.create'); @endphp
            <a href="{{ route('admin.questions.create') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ $active ? 'bg-indigo-600/20 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Nova Questão</span>
            </a>

        </nav>

        {{-- Footer --}}
        <div class="px-3 py-4 border-t border-slate-800 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Voltar à plataforma</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ─────────────────────────────────────── --}}
    <div class="ml-64 flex-1 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 bg-zinc-950/80 backdrop-blur border-b border-slate-800 px-8 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-white font-bold text-lg leading-none">{{ $title ?? 'Painel Administrativo' }}</h1>
                <p class="text-slate-500 text-xs mt-0.5">{{ $subtitle ?? 'Gerenciamento da plataforma' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold text-white leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-indigo-400 mt-0.5">Administrador</p>
                </div>
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-8 mt-6 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-8 mt-6 flex items-center gap-3 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <main class="flex-1 px-8 py-6">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
