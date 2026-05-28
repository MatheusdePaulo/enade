<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Meu Desempenho</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Header Card --}}
            <div class="relative bg-gradient-to-r from-indigo-600 to-violet-700 rounded-2xl p-8 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg viewBox="0 0 100 100" class="w-full h-full" preserveAspectRatio="none">
                        <circle cx="80" cy="20" r="40" fill="white"/>
                    </svg>
                </div>
                <div class="relative">
                    <p class="text-indigo-200 text-sm mb-1">Sessão atual</p>
                    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $media }}%</h1>
                    <p class="text-indigo-200 text-sm">Taxa de acertos — {{ $stats['total_corretas'] }} de {{ $stats['total_respondidas'] }} questões corretas</p>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $stats['total_respondidas'] }}</div>
                    <div class="text-sm text-slate-500">Total respondidas</div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $stats['total_corretas'] }}</div>
                    <div class="text-sm text-slate-500">Acertos</div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $stats['total_respondidas'] - $stats['total_corretas'] }}</div>
                    <div class="text-sm text-slate-500">Erros</div>
                </div>
            </div>

            {{-- Progress Bar --}}
            @if($stats['total_respondidas'] > 0)
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4">Taxa de acertos</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 bg-slate-100 rounded-full h-4 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-700
                                {{ $media >= 70 ? 'bg-green-500' : ($media >= 50 ? 'bg-amber-500' : 'bg-red-500') }}"
                                 style="width: {{ $media }}%"></div>
                        </div>
                        <span class="font-bold text-slate-700 text-lg w-14 text-right">{{ $media }}%</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-3">
                        @if($media >= 70)
                            Excelente desempenho! Continue assim para garantir sua aprovação.
                        @elseif($media >= 50)
                            Bom progresso! Revise os temas com mais erros para melhorar ainda mais.
                        @else
                            Foque em revisar o conteúdo e pratique mais questões do banco.
                        @endif
                    </p>
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 border border-slate-100 shadow-sm text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-700 mb-2">Nenhuma questão respondida ainda</h3>
                    <p class="text-sm text-slate-400 mb-6">Faça um simulado ou pratique questões para ver seu desempenho aqui.</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('simulado.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                            Fazer Simulado
                        </a>
                        <a href="{{ route('pratica.index') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:border-indigo-300 text-slate-700 font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                            Banco de Questões
                        </a>
                    </div>
                </div>
            @endif

            {{-- Banco total --}}
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-6 flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm mb-0.5">Disponível no banco</p>
                    <p class="text-white font-extrabold text-2xl">{{ $totalQuestions }} questões</p>
                </div>
                <a href="{{ route('pratica.index') }}"
                   class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-400 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                    Praticar agora
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
