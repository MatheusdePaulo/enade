<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Histórico de Simulados</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($stats['total_respondidas'] > 0)
                @php
                    $media = round(($stats['total_corretas'] / $stats['total_respondidas']) * 100);
                @endphp

                {{-- Summary Card --}}
                <div class="relative bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-2xl p-7 overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <svg viewBox="0 0 100 100" class="w-full h-full"><circle cx="80" cy="20" r="50" fill="white"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-indigo-200 text-sm mb-1">Resumo da sessão atual</p>
                        <div class="flex items-end gap-4">
                            <div class="text-5xl font-extrabold text-white">{{ $media }}%</div>
                            <div class="text-indigo-200 text-sm pb-1">
                                {{ $stats['total_corretas'] }} acertos<br>
                                em {{ $stats['total_respondidas'] }} questões
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Session Stats --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h3 class="font-bold text-slate-800 mb-5">Detalhes da sessão</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">Total de questões respondidas</span>
                            </div>
                            <span class="font-bold text-slate-900">{{ $stats['total_respondidas'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">Questões corretas</span>
                            </div>
                            <span class="font-bold text-green-600">{{ $stats['total_corretas'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">Questões incorretas</span>
                            </div>
                            <span class="font-bold text-red-500">{{ $stats['total_respondidas'] - $stats['total_corretas'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 {{ $media >= 70 ? 'bg-green-100' : ($media >= 50 ? 'bg-amber-100' : 'bg-red-100') }} rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 {{ $media >= 70 ? 'text-green-600' : ($media >= 50 ? 'text-amber-600' : 'text-red-500') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">Taxa de acertos</span>
                            </div>
                            <span class="font-bold {{ $media >= 70 ? 'text-green-600' : ($media >= 50 ? 'text-amber-600' : 'text-red-500') }}">{{ $media }}%</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('simulado.index') }}" class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3.5 rounded-xl text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Novo Simulado
                    </a>
                    <a href="{{ route('desempenho.index') }}" class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-indigo-300 text-slate-700 font-semibold py-3.5 rounded-xl text-sm transition">
                        Ver Desempenho Detalhado
                    </a>
                </div>

            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-14 text-center">
                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Nenhum simulado realizado</h3>
                    <p class="text-sm text-slate-500 mb-7 max-w-sm mx-auto">
                        Após concluir um simulado, seu histórico de desempenho aparecerá aqui.
                    </p>
                    <a href="{{ route('simulado.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Iniciar Simulado
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
