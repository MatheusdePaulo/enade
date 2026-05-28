<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
     :class="scrolled ? 'shadow-lg shadow-slate-900/20' : ''"
     class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 transition-shadow duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center">
                <img src="{{ asset('images/logo-wel.png') }}" alt="Logo" class="h-20 w-auto object-contain drop-shadow-sm">
            </a>

            {{-- Desktop Navigation Links --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navItems = [
                        ['route' => 'dashboard',       'label' => 'Início',           'match' => 'dashboard',       'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['route' => 'simulado.index',  'label' => 'Simulado',         'match' => 'simulado.*',      'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
                        ['route' => 'pratica.index',   'label' => 'Banco de Questões','match' => 'pratica.*',       'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
                        ['route' => 'desempenho.index','label' => 'Desempenho',       'match' => 'desempenho.*',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
                        ['route' => 'forum.index',     'label' => 'Fórum',            'match' => 'forum.*',         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>'],
                        ['route' => 'historico.index', 'label' => 'Histórico',        'match' => 'historico.*',     'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9"/>'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php $isActive = request()->routeIs($item['match']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-150
                              {{ $isActive
                                  ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30'
                                  : 'text-slate-400 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- User Dropdown --}}
            <div class="hidden sm:flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-xs text-slate-400 leading-none mb-0.5">Logado como</p>
                    <p class="text-sm font-semibold text-white leading-none">{{ Auth::user()->name }}</p>
                </div>

                <x-dropdown align="right" width="52">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/10 hover:border-white/20 px-3 py-2 rounded-xl text-white text-sm font-medium transition-all duration-150">
                            <div class="w-6 h-6 bg-indigo-500 rounded-md flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-xs text-slate-500">Conta</p>
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Meu Perfil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2 text-red-600 hover:text-red-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="open = !open"
                    class="lg:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-white/10 bg-slate-900/95 backdrop-blur-sm">
        <div class="px-4 py-3 space-y-1">
            @php
                $mobileItems = [
                    ['route' => 'dashboard',       'label' => 'Início',            'match' => 'dashboard'],
                    ['route' => 'simulado.index',  'label' => 'Simulado',          'match' => 'simulado.*'],
                    ['route' => 'pratica.index',   'label' => 'Banco de Questões', 'match' => 'pratica.*'],
                    ['route' => 'desempenho.index','label' => 'Desempenho',        'match' => 'desempenho.*'],
                    ['route' => 'forum.index',     'label' => 'Fórum',             'match' => 'forum.*'],
                    ['route' => 'historico.index', 'label' => 'Histórico',         'match' => 'historico.*'],
                ];
            @endphp
            @foreach($mobileItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="block px-3 py-2.5 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs($item['match'])
                              ? 'bg-indigo-500/20 text-indigo-300'
                              : 'text-slate-300 hover:text-white hover:bg-white/10' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
        <div class="px-4 py-3 border-t border-white/10">
            <div class="mb-2">
                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-slate-300 hover:text-white rounded-lg hover:bg-white/10 transition">Meu Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-400 hover:text-red-300 rounded-lg hover:bg-white/10 transition">
                    Sair
                </button>
            </form>
        </div>
    </div>
</nav>
